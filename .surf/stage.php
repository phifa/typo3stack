<?php
/** @var \TYPO3\Surf\Domain\Model\Deployment $deployment */

use TYPO3\Surf\Domain\Model\Node;
use TYPO3\Surf\Domain\Model\SimpleWorkflow;

$username = 'p12345';
$baseUrl = 'http://p12345.mittwaldserver.info/typo3/releases/current/public/';
$scriptBasePath = '/root/.surf/workspace/stage/TYPO3 CMS/public';

$projectName = 'Project Name';
$deploymentPath = '/home/www/' . $username . '/html/typo3';
$deploymentHost = $username . '.mittwaldserver.info';
$repositoryUrl = 'git@bitbucket.org:vendor/project.git';
$repositoryBranch = getenv('DEPLOY_BRANCH') ?: 'stage';
$composerCommandPath = 'composer';
// Set this, if on remote host the correct PHP binary is not available in PATH
$deployment->setOption('phpBinaryPathAndFilename', '/usr/local/php/bin/php_cli');

$node = new Node($deploymentHost);
$node->setHostname($deploymentHost);
$node->setOption('username', $username);

// No changes are required in the default case below this point.
$application = new \TYPO3\Surf\Application\TYPO3\CMS();
$application
    ->setContext('Production')
    ->addNode($node)
    ->setDeploymentPath($deploymentPath)
    ->setOption('projectName', $projectName)
    ->setOption('repositoryUrl', $repositoryUrl)
    ->setOption('branch', $repositoryBranch)
    ->setOption('keepReleases', 3)
    ->setOption('webDirectory', 'public')
    ->setOption('composerCommandPath', $composerCommandPath)
    ->setOption('scriptBasePath', $scriptBasePath)
    ->setOption('baseUrl', $baseUrl)
    ->setOption('TYPO3\\Surf\\Task\\TYPO3\\CMS\\SymlinkDataTask[applicationRootDirectory]', 'public')
    ->setOption('TYPO3\\Surf\\Task\\Transfer\\RsyncTask[rsyncExcludes]', array(
        '.git',
        '.surf',
        'public/fileadmin',
        'public/uploads',
    ));

$deployment->addApplication($application);
$deployment->onInitialize(function () use ($deployment) {
    /** @var SimpleWorkflow $workflow */
    $workflow = $deployment->getWorkflow();
    $workflow
        ->setEnableRollback(false)
        ->defineTask('Helhum\\TYPO3\\Distribution\\DefinedTask\\EnvAwareTask', 'TYPO3\\Surf\\Task\\ShellTask', array(
            'command' => array(
                "cp {sharedPath}/.env {releasePath}/.env",
                "cd {releasePath}",
            ),
        ))
        ->defineTask('Helhum\\TYPO3\\Distribution\\DefinedTask\\CopyIndexPhp', 'TYPO3\\Surf\\Task\\ShellTask', array(
            'command' => array(
                "rm {releasePath}/public/index.php",
                "cp {releasePath}/vendor/typo3/cms/index.php {releasePath}/public/index.php",
            ),
        ))
        ->defineTask('Helhum\\TYPO3\\Distribution\\DefinedTask\\ComposerInstall', 'TYPO3\\Surf\\Task\\ShellTask', [
            'command' => [
                'cd {releasePath} && composer install --no-dev',
            ],
        ])
        ->removeTask('TYPO3\\Surf\\Task\\TYPO3\\CMS\\CreatePackageStatesTask')
        ->removeTask('TYPO3\\Surf\\Task\\TYPO3\\CMS\\SetUpExtensionsTask')
        // Clear PHP 5.5+ OpCache (required for php-fpm)
        ->beforeStage('transfer', 'TYPO3\\Surf\\Task\\Php\\WebOpcacheResetCreateScriptTask')
        //->afterStage('transfer', 'Helhum\\TYPO3\\Distribution\\DefinedTask\\CopyIndexPhp')
        ->afterStage('switch', 'TYPO3\\Surf\\Task\\Php\\WebOpcacheResetExecuteTask')
        ->afterTask('TYPO3\\Surf\\Task\\Generic\\CreateSymlinksTask', 'Helhum\\TYPO3\\Distribution\\DefinedTask\\EnvAwareTask')
        #->afterTask('Helhum\\TYPO3\\Distribution\\DefinedTask\\EnvAwareTask', 'Helhum\\TYPO3\\Distribution\\DefinedTask\\ComposerInstall')
        ->forStage('finalize', 'TYPO3\\Surf\\Task\\TYPO3\\CMS\\FlushCachesTask');
});
