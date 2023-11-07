<?php
namespace MediaWiki\Extension\JWTAuth;

use MediaWiki\MediaWikiServices;
use Psr\Log\LoggerInterface;
use UnlistedSpecialPage;

class TestJWTAuth extends UnlistedSpecialPage {
	const JWT_TEST_SPECIAL_PAGE = 'TestJWTAuth';
	const JWT_PARAMETER = 'Authorization';

	private JWTHandler $jwtHandler;
	private $mwConfig;
	private \MediaWiki\User\UserGroupManager $userGroupManager;
	private LoggerInterface $logger;

	private $debugMode;

	public function __construct() {
		parent::__construct( self::JWT_TEST_SPECIAL_PAGE );

		$mwServicesInstance = MediaWikiServices::getInstance();

		$this->mwConfig = $mwServicesInstance
			->getConfigFactory()
			->makeConfig( 'JWTAuth' );

		$this->debugMode = $this->mwConfig->get( 'JWTAuthDebugMode' );
	}

	/**
	 * @param string $subpage
	 * @return void
	 */
	public function execute( $subpage ) {
		if ( !$this->debugMode ) {
			return;
		}

		$out = $this->getOutput();
		$out->enableOOUI();
		$out->addHTML(
			<<<EOF
            <form method="post" action="/wiki/Special:JWTLogin">
                <input type="text" name="Authorization" value="Bearer: blahblahblah">
                <input type="submit">
            </form>
            EOF
		);
	}

	public function doesWrites() {
		return false;
	}
}
