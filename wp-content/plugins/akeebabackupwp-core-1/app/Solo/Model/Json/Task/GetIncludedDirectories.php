<?php
/**
 * @package        solo
 * @copyright      2014-2016 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

namespace Solo\Model\Json\Task;

use Akeeba\Engine\Platform;
use Solo\Application;
use Solo\Model\Extradirs;
use Solo\Model\Json\TaskInterface;

/**
 * Get the extra included directories
 */
class GetIncludedDirectories implements TaskInterface
{
	/**
	 * Return the JSON API task's name ("method" name). Remote clients will use it to call us.
	 *
	 * @return  string
	 */
	public function getMethodName()
	{
		return 'getIncludedDirectories';
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
		// Get the passed configuration values
		$defConfig = array(
			'profile' => 0,
		);

		$defConfig = array_merge($defConfig, $parameters);

		$profile = (int)$defConfig['profile'];

		if ($profile <= 0)
		{
			$profile = 1;
		}

		$session = Application::getInstance()->getContainer()->segment;
		$session->set('profile', $profile);

		// Load the configuration
		Platform::getInstance()->load_configuration($profile);

		/** @var \Solo\Model\Extradirs $model */
		$model = new Extradirs();

		return $model->get_directories();
	}
}