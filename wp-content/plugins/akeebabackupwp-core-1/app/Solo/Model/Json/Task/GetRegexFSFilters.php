<?php
/**
 * @package        solo
 * @copyright      2014-2016 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

namespace Solo\Model\Json\Task;

use Akeeba\Engine\Platform;
use Solo\Application;
use Solo\Model\Regexfsfilters;
use Solo\Model\Json\TaskInterface;

/**
 * Get the regex filesystem filters
 */
class GetRegexFSFilters implements TaskInterface
{
	/**
	 * Return the JSON API task's name ("method" name). Remote clients will use it to call us.
	 *
	 * @return  string
	 */
	public function getMethodName()
	{
		return 'getRegexFSFilters';
	}

	/**
	 * Execute the JSON API task
	 *
	 * @param   array $parameters The parameters to this task
	 *
	 * @return  mixed
	 *
	 * @throws  \RuntimeException  In case of an error
	 */
	public function execute(array $parameters = array())
	{
		$filter = \Awf\Input\Filter::getInstance();

		// Get the passed configuration values
		$defConfig = array(
			'profile' => 0,
			'root'    => '[SITEROOT]',
		);

		$defConfig = array_merge($defConfig, $parameters);

		$profile = $filter->clean($defConfig['profile'], 'int');
		$root    = $filter->clean($defConfig['root'], 'string');

		// We need a valid profile ID
		if ($profile <= 0)
		{
			$profile = 1;
		}

		// We need a root
		if (empty($root))
		{
			throw new \RuntimeException('Unknown database root', 500);
		}

		$session = Application::getInstance()->getContainer()->segment;
		$session->set('profile', $profile);

		// Load the configuration
		Platform::getInstance()->load_configuration($profile);

		/** @var \Solo\Model\Regexfsfilters $model */
		$model = new Regexfsfilters();

		return $model->get_regex_filters($root);
	}
}