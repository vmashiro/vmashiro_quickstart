<?php
/**
 * @package angi4j
 * @copyright Copyright (C) 2009-2016 Nicholas K. Dionysopoulos. All rights reserved.
 * @author Nicholas K. Dionysopoulos - http://www.dionysopoulos.me
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later
 */

defined('_AKEEBA') or die();

class AngieModelWordpressFinalise extends AngieModelBaseFinalise
{
	public function updatehtaccess()
	{
		// Make sure we have a file
		$fileName = APATH_ROOT . '/.htaccess';

		if (!@file_exists($fileName))
		{
			$fileName = APATH_ROOT . '/htaccess.bak';
		}

		if (!@file_exists($fileName))
		{
			return true;
		}

		// Get the site's URL
		/** @var AngieModelWordpressConfiguration $config */
		$config  = AModel::getAnInstance('Configuration', 'AngieModel');
		$new_url = $config->get('siteurl');
		$homeurl = $config->get('homeurl');
		$newURI = new AUri($new_url);
		$path = $newURI->getPath();

		// Load the .htaccess in memory
		$contents = @file_get_contents($fileName);

		if ($contents === false)
		{
			return false;
		}

		// Explode its lines
		$lines = explode("\n", $contents);
		$contents = '';
		$inSection = null;

		foreach ($lines as $line)
		{
			// Fix naughty Windows users' doing
			$line = rtrim($line, "\r");

			// If we are not inside the WordPress section look for the BEGIN signature
			if (is_null($inSection))
			{
				if (strpos($line, '# BEGIN WordPress') === 0)
				{
					$inSection = true;
				}
			}
			// If we are inside the WordPress section do the necessary manipulation
			elseif ($inSection)
			{
				if (strpos($line, '# END WordPress') === 0)
				{
					$inSection = false;
				}
				elseif (strpos($line, 'RewriteBase ') === 0)
				{
					$line = "RewriteBase $path";

					// If the site is hosted on the domain's root
					if (empty($path))
					{
						$line = "RewriteBase /";
					}
				}
				elseif (strpos($line, 'RewriteRule .') === 0)
				{
					$line = 'RewriteRule . ' . $path . '/index.php [L]';
				}
			}

			// Add the line
			$contents .= "$line\n";
		}

		// Write the new .htaccess
		$fileName = APATH_ROOT . '/.htaccess';
		file_put_contents($fileName, $contents);

		// If the homeurl and siteurl don't match, copy the .htaccess file and index.php in the correct directory
		if ($new_url != $homeurl)
		{
			$homeUri = new AUri($homeurl);
			$homePath = $homeUri->getPath();

			if (strpos($path, $homePath) !== 0)
			{
				// I have no clue where to put the files so I'll do nothing at all :s
				return true;
			}

			// $homePath is WITHOUT /wordpress_dir (/foobar); $path is the one WITH /wordpress_dir (/foobar/wordpress_dir)
			$homePath = ltrim($homePath, '/\\');
			$path = ltrim($path, '/\\');
			$homeParts = explode('/', $homePath);
			$siteParts = explode('/', $path);

			$numHomeParts = count($homeParts);
			$siteParts = array_slice($siteParts, $numHomeParts);

			// Relative path from HOME to SITE (WP) root
			$relPath = implode('/', $siteParts);

			// How many directories above the root (where we are restoring) is our site's root
			$levelsUp = count($siteParts);

			// Determine the path where the index.php and .htaccess files will be written to
			$targetPath = APATH_ROOT . str_repeat('/..', $levelsUp);
			$targetPath = realpath($targetPath) ? realpath($targetPath) : $targetPath;

			// Copy the files
			if (!@copy(APATH_ROOT . '/.htaccess', $targetPath . '/.htaccess'))
			{
				return false;
			}

			if (!@copy(APATH_ROOT . '/index.php', $targetPath . '/index.php'))
			{
				return false;
			}

			// Edit the index.php file
			$fileName = $targetPath . '/index.php';
			$fileContents = @file($fileName);

			if (empty($fileContents))
			{
				return false;
			}

			foreach ($fileContents as $index => $line)
			{
				$line = trim($line);

				if (strstr($line, 'wp-blog-header.php') && (strpos($line, 'require') === 0))
				{
					$line = "require( dirname( __FILE__ ) . '/$relPath/wp-blog-header.php' );";
				}

				$fileContents[$index] = $line;
			}

			$fileContents = implode("\n", $fileContents);
			@file_put_contents($fileName, $fileContents);
		}

		return true;
	}
}