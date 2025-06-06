<?php
namespace Bynder\Test\AssetBank;

use Bynder\Api\Impl\AssetBankManager;
use DateTime;
use PHPUnit\Framework\TestCase;

class AssetBankManagerTest extends TestCase
{

    /**
     * Test if we call getUsers it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getUsers()
     * @throws \Exception
     */
    public function testGetUsers()
    {
        $returnedBrands = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $query = [
            'includeInActive' => true,
            'limit' => 50,
            'page' => 2
        ];

        $stub->expects($this->once())
            ->method('sendRequestAsync')
            ->with('GET', 'api/v4/users/', ['query' => $query])
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $brands = $assetBankManager->getUsers($query);

        self::assertNotNull($brands);
        self::assertEquals($brands, $returnedBrands);
    }

    /**
     * Test if we call getProfiles it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getProfiles()
     * @throws \Exception
     */
    public function testGetProfiles()
    {
        $returnedBrands = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->expects($this->once())
            ->method('sendRequestAsync')
            ->with('GET', 'api/v4/profiles/')
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $brands = $assetBankManager->getProfiles();

        self::assertNotNull($brands);
        self::assertEquals($brands, $returnedBrands);
    }

    /**
     * Test if we call getAccount it will use the correct params for the request and returns successfully.
     *
     * @group  collections
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getCollections()
     * @throws \Exception
     */
    public function testGetAccount()
    {
        $returnedAccount = [
            "availableLanguages" => [
                "nl_NL",
                "en_GB",
                "en_US",
                "fr_FR",
                "de_DE",
                "it_IT",
                "es_ES",
                "pl_PL",
            ],
            "defaultLanguage"    => "en_US",
            "name"               => "Bynder",
            "timeZone"           => "Europe/Amsterdam",
            "isOpenImageBank"    => false,
        ];

        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', "api/v4/account/")
            ->willReturn($returnedAccount);

        $assetBankManager = new AssetBankManager($stub);
        $account          = $assetBankManager->getAccount();

        self::assertNotNull($account);
        self::assertEquals($account, $returnedAccount);
    }

    /**
     * Test if we call getBrands it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getBrands()
     * @throws \Exception
     */
    public function testGetBrands()
    {
        $returnedBrands = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->expects($this->once())
            ->method('sendRequestAsync')
            ->with('GET', 'api/v4/brands/')
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $brands = $assetBankManager->getBrands();

        self::assertNotNull($brands);
        self::assertEquals($brands, $returnedBrands);
    }

    /**
     * Test if we call getMediaList it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMediaList()
     * @throws \Exception
     */
    public function testGetMediaList()
    {
        $returnedMedia = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/media/')
            ->willReturn($returnedMedia);

        $assetBankManager = new AssetBankManager($stub);
        $mediaList = $assetBankManager->getMediaList();

        self::assertNotNull($mediaList);
        self::assertEquals($mediaList, $returnedMedia);

        // Test with query params.
        $query = [
            'count' => true,
            'limit' => 2,
            'type' => 'image'
        ];
        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/media/', ['query' => $query])
            ->willReturn($returnedMedia);

        $assetBankManager = new AssetBankManager($stub);
        $mediaList = $assetBankManager->getMediaList($query);

        self::assertNotNull($mediaList);
        self::assertEquals($mediaList, $returnedMedia);
    }

    /**
     * Test if we call getMediaInfo it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMediaInfo()
     * @throws \Exception
     */
    public function testGetMediaInfo()
    {
        $returnedMedia = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/media/1111/')
            ->willReturn($returnedMedia);

        $assetBankManager = new AssetBankManager($stub);
        $mediaInfo = $assetBankManager->getMediaInfo('1111');

        self::assertNotNull($mediaInfo);
        self::assertEquals($mediaInfo, $returnedMedia);

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/media/1111/')
            ->willReturn($returnedMedia);

        $assetBankManager = new AssetBankManager($stub);
        $mediaInfo = $assetBankManager->getMediaInfo('1111');

        self::assertNotNull($mediaInfo);
        self::assertEquals($mediaInfo, $returnedMedia);
    }

    /**
     * Test if we call getMetaproperties it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMetaproperties()
     * @throws \Exception
     */
    public function testGetMetaproperties()
    {
        $returnedMedia = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/metaproperties/')
            ->willReturn($returnedMedia);

        $assetBankManager = new AssetBankManager($stub);
        $metaproperties = $assetBankManager->getMetaproperties();

        self::assertNotNull($metaproperties);
        self::assertEquals($metaproperties, $returnedMedia);

        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/metaproperties/', [
                'query' => ['count' => 1]
                ]
            )
            ->willReturn(['query']);

        $assetBankManager = new AssetBankManager($stub);
        $metaproperties = $assetBankManager->getMetaproperties(['count' => 1]);

        self::assertNotNull($metaproperties);
        self::assertEquals($metaproperties, ['query']);
    }

    /**
     * Test if we call getTags it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getTags()
     * @throws \Exception
     */
    public function testGetTags()
    {
        $returnedMedia = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/tags/')
            ->willReturn($returnedMedia);

        $assetBankManager = new AssetBankManager($stub);
        $tagList = $assetBankManager->getTags();

        self::assertNotNull($tagList);
        self::assertEquals($tagList, $returnedMedia);

        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/tags/', [
                'query' => ['limit' => 10]
                ]
            )
            ->willReturn(['query']);

        $assetBankManager = new AssetBankManager($stub);
        $tagList = $assetBankManager->getTags(['limit' => 10]);

        self::assertNotNull($tagList);
        self::assertEquals($tagList, ['query']);
    }

    /**
     * Test if we call getCategories it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getCategories()
     * @throws \Exception
     */
    public function testGetCategories()
    {
        $returnedMedia = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/categories')
            ->willReturn($returnedMedia);

        $assetBankManager = new AssetBankManager($stub);
        $categoryList = $assetBankManager->getCategories();

        self::assertNotNull($categoryList);
        self::assertEquals($categoryList, $returnedMedia);
    }

    /**
     * Test if we call getSmartfilters it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getSmartfilters()
     * @throws \Exception
     */
    public function testGetSmartFilters()
    {
        $returnedMedia = array();
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/smartfilters')
            ->willReturn($returnedMedia);

        $assetBankManager = new AssetBankManager($stub);
        $smartFilters= $assetBankManager->getSmartfilters();

        self::assertNotNull($smartFilters);
        self::assertEquals($smartFilters, $returnedMedia);
    }

    /**
     * Test if we call modifyMedia it will use the correct params for the request and returns successfully.
     * HINT: it is rather skeleton, to use it properly this test requires much more complex mock with configured asset
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::modifyMedia()
     * @throws \Exception
     */
    public function testModifyMedia()
    {
        $return = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $mediaId = 1111;
        $formData = ['name' => 'test'];

        $stub->method('sendRequestAsync')
            ->with('POST', 'api/v4/media/'.$mediaId.'/', ['form_params' => $formData])
            ->willReturn($return);

        $assetBankManager = new AssetBankManager($stub);
        $modifyMediaReturn = $assetBankManager->modifyMedia($mediaId, $formData);

        self::assertNotNull($modifyMediaReturn);
        self::assertEquals($modifyMediaReturn, $return);
    }

    /**
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getDerivatives()
     * @throws \Exception
     */
    public function testGetDerivatives()
    {
        $returnedMedia = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/account/derivatives/')
            ->willReturn($returnedMedia);

        $assetBankManager = new AssetBankManager($stub);
        $derivativesList = $assetBankManager->getDerivatives();

        self::assertNotNull($derivativesList);
        self::assertEquals($derivativesList, $returnedMedia);
    }

    /**
     * Test if we call getMediaDownloadLocation it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMediaDownloadLocation()
     * @throws \Exception
     */
    public function testGetMediaDownloadLocation()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $mediaId = 1111;
        $type = 'original';

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/media/' . $mediaId . '/download/', [
                    'query' => [
                        'type' => $type
                    ]
                ]
            )
            ->willReturn(['query']);

        $assetBankManager = new AssetBankManager($stub);
        $mediaLocation = $assetBankManager->getMediaDownloadLocation($mediaId);

        self::assertNotNull($mediaLocation);
        self::assertEquals($mediaLocation, ['query']);
    }

    /**
     * Test if we call getMediaDownloadLocationByVersion it will use the correct params for the request and returns
     * successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMediaDownloadLocation()
     * @throws \Exception
     */
    public function testGetMediaDownloadLocationByVersion()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $mediaId = 1111;
        $version = 3;

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/media/' . $mediaId . '/' . $version . '/download/')
            ->willReturn(array());

        $assetBankManager = new AssetBankManager($stub);
        $mediaLocation = $assetBankManager->getMediaDownloadLocationByVersion($mediaId, $version);

        self::assertNotNull($mediaLocation);
        self::assertEquals($mediaLocation, array());
    }

    /**
     * Test if we call getMediaDownloadLocationForAssetItem it will use the correct params for the request and returns
     * successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMediaDownloadLocation()
     * @throws \Exception
     */
    public function testGetMediaDownloadLocationForAssetItem()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $mediaId = 1111;
        $itemId = 2222;
        $hash = false;

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/media/' . $mediaId . '/download/' . $itemId . '/', [
                    'query' => [
                        'hash' => $hash
                    ]
                ]
            )
            ->willReturn(['query']);

        $assetBankManager = new AssetBankManager($stub);
        $mediaLocation = $assetBankManager->getMediaDownloadLocationForAssetItem($mediaId, $itemId);

        self::assertNotNull($mediaLocation);
        self::assertEquals($mediaLocation, ['query']);
    }

    /**
     * Test if we call getMetaproperty it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMetaproperty()
     * @throws \Exception
     */
    public function testGetMetapropery()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $propertyId = '00000000-0000-0000-0000000000000000';
        $count = true;

        $stub->method('sendRequestAsync')
             ->with('GET', 'api/v4/metaproperties/' . $propertyId . '/', [
                 'query' => [
                     'count' => $count
                 ]
             ])
            ->willReturn(['query']);

        $assetBankManager = new AssetBankManager($stub);
        $mediaLocation = $assetBankManager->getMetaproperty($propertyId, ['count' => $count]);

        self::assertNotNull($mediaLocation);
        self::assertEquals($mediaLocation, ['query']);
    }

    /**
     * Test if we call getMetapropertyDependencies it will use the correct params for the request and returns
     * successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMetapropertyDependencies()
     * @throws \Exception
     */
    public function testGetMetapropertyDependencies()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $propertyId = '00000000-0000-0000-0000000000000000';

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/metaproperties/' . $propertyId . '/dependencies/')
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $mediaLocation = $assetBankManager->getMetapropertyDependencies($propertyId);

        self::assertNotNull($mediaLocation);
        self::assertEquals($mediaLocation, []);
    }

    /**
     * Test if we call getMetapropertyOptions it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMetapropertyOptions()
     * @throws \Exception
     */
    public function testGetMetapropertyOptions()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $optionId = '00000000-0000-0000-0000000000000000';
        $query = ['ids' => $optionId];

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/metaproperties/options/', [
                    'query' => $query
            ])
            ->willReturn(['query']);

        $assetBankManager = new AssetBankManager($stub);
        $result = $assetBankManager->getMetapropertyOptions($query);

        self::assertNotNull($result);
        self::assertEquals($result, ['query']);
    }

    /**
     * Test if we call getMetapropertyOptionsById it will use the correct params for the request and returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMetapropertyOptionsById()
     * @throws \Exception
     */
    public function testGetMetapropertyOptionsById()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $propertyId = '00000000-0000-0000-0000000000000000';
        $optionId = '00000000-0000-0000-0000000000000001';
        $query = ['ids' => $optionId];

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/metaproperties/' . $propertyId . '/options/', [
                    'query' => $query
            ])
            ->willReturn(['query']);

        $assetBankManager = new AssetBankManager($stub);
        $result = $assetBankManager->getMetapropertyOptionsById($propertyId, $query);

        self::assertNotNull($result);
        self::assertEquals($result, ['query']);
    }

    /**
     * Tests the createMetaPropertyOption function.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::createMetaPropertyOption()
     * @throws \Exception
     */
    public function testCreateMetaPropertyOption()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $queryData = [
            'name'              => 'TEST_NAME',
            'externalReference' => 'TEST_EXTERNAL_REFERENCE',
            'label'             => 'TEST_EXTERNAL_LABEL',
        ];

        $stub->method('sendRequestAsync')
            ->with('POST', 'api/v4/metaproperties/TEST_METAPROPERTY_ID/options/', [
                'form_params' => ['data' => json_encode($queryData)],
            ])
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $result           = $assetBankManager->createMetaPropertyOption('TEST_METAPROPERTY_ID', $queryData);

        self::assertNotNull($result);
        self::assertEquals($result, []);
    }

    /**
     * Tests the modifyMetaPropertyOption function.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::createMetaPropertyOption()
     * @throws \Exception
     */
    public function testModifyMetaPropertyOption()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $queryData = [
            'name'              => 'TEST_NAME',
            'externalReference' => 'TEST_EXTERNAL_REFERENCE',
            'label'             => 'TEST_EXTERNAL_LABEL',
        ];

        $stub->method('sendRequestAsync')
            ->with('POST', 'api/v4/metaproperties/TEST_METAPROPERTY_ID/options/TEST_OPTION_ID/', [
                'form_params' => ['data' => json_encode($queryData)],
            ])
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $result           = $assetBankManager->modifyMetaPropertyOption(
            'TEST_METAPROPERTY_ID',
            'TEST_OPTION_ID',
            $queryData
        );

        self::assertNotNull($result);
        self::assertEquals($result, []);
    }

    /**
     * Test if we call getMetapropetryGlobalOptionDependencies it will use the correct params for the request and
     * returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMetapropetryGlobalOptionDependencies()
     * @throws \Exception
     */
    public function testGetMetapropetryGlobalOptionDependencies()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/metaproperties/options/dependencies/')
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $result = $assetBankManager->getMetapropetryGlobalOptionDependencies();

        self::assertNotNull($result);
        self::assertEquals($result, []);
    }

    /**
     * Test if we call getMetapropertyOptionDependencies it will use the correct params for the request and returns
     * successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMetapropertyOptionDependencies()
     * @throws \Exception
     */
    public function testGetMetapropertyOptionDependencies()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $propertyId = '00000000-0000-0000-0000000000000000';

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/metaproperties/' . $propertyId . '/options/dependencies/')
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $result = $assetBankManager->getMetapropertyOptionDependencies($propertyId);

        self::assertNotNull($result);
        self::assertEquals($result, []);
    }

    /**
     * Test if we call getMetapropertySpecificOptionDependencies it will use the correct params for the request and
     * returns successfully.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getMetapropertySpecificOptionDependencies()
     * @throws \Exception
     */
    public function testGetMetapropertySpecificOptionDependencies()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $propertyId = '00000000-0000-0000-0000000000000000';
        $optionId = '00000000-0000-0000-0000000000000000';

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/metaproperties/' . $propertyId . '/options/' . $optionId . '/dependencies/', [
                'query' => ['includeGroupedResults' => false]
            ])
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $result = $assetBankManager->getMetapropertySpecificOptionDependencies($propertyId, $optionId, ['includeGroupedResults' => false]);

        self::assertNotNull($result);
        self::assertEquals($result, []);
    }

    /**
     * Tests the CreateUsage function.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::createUsage()
     * @throws \Exception
     */
    public function testCreateAssetUsage()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $queryData = [
            'integration_id' => 'TEST_INTEGRATION_ID',
            'asset_id' => 'TEST_MEDIA_ID',
            'timestamp' =>  date(DateTime::ISO8601),
            'uri' => '/posts/1',
            'additional' => 'Testing usage tracking'
        ];

        $stub->method('sendRequestAsync')
            ->with('POST', 'api/media/usage', [
                'form_params' => $queryData
            ])
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $result = $assetBankManager->createUsage($queryData);

        self::assertNotNull($result);
        self::assertEquals($result, []);
    }

    /**
     * Tests the GetUsage function.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getUsage()
     * @throws \Exception
     */
    public function testGetAssetUsage()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $queryData = [
            'asset_id' => 'TEST_MEDIA_ID',
        ];

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/media/usage', [
                'query' => $queryData
            ])
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $result = $assetBankManager->getUsage($queryData);

        self::assertNotNull($result);
        self::assertEquals($result, []);
    }

    /**
     * Tests the DeleteUsage function.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::deleteUsage()
     * @throws \Exception
     */
    public function testDeleteAssetUsage()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $queryData = [
            'integration_id' => 'TEST_INTEGRATION_ID',
            'asset_id' => 'TEST_MEDIA_ID',
            'uri' => '/posts/1',
        ];

        $stub->method('sendRequestAsync')
            ->with('DELETE', 'api/media/usage', [
                'query' => $queryData
            ])
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $result = $assetBankManager->deleteUsage($queryData);

        self::assertNotNull($result);
        self::assertEquals($result, array());
    }

    /**
     * Tests the syncAssetUsage function.
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::deleteUsage()
     * @throws \Exception
     */
    public function testSyncAssetUsage()
    {
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $queryData = [
            'integration_id' => 'TEST_INTEGRATION_ID',
            'uris'           => ['TEST_URI_1', 'TEST_URI_2', 'TEST_URI_TO_DELETE_1'],
            'usages'         => [
                'integration_id' => 'TEST_INTEGRATION_ID',
                'asset_id'       => 'TEST_ASSET_ID_1',
                'timestamp'      => (new \Datetime())->format('Y-m-d\TH:i:s\Z'),
                'additional'     => 'TEST_ADDITIONAL_DATA_1',
                'uri'            => 'TEST_URI_1',
            ],
            [
                'integration_id' => 'TEST_INTEGRATION_ID',
                'asset_id'       => 'TEST_ASSET_ID_2',
                'timestamp'      => (new \Datetime())->format('Y-m-d\TH:i:s\Z'),
                'additional'     => 'TEST_ADDITIONAL_DATA_2',
                'uri'            => 'TEST_URI_2',
            ],
        ];

        $stub->method('sendRequestAsync')
            ->with('POST', 'api/media/usage/sync', [
                'json' => $queryData,
            ])
            ->willReturn([]);

        $assetBankManager = new AssetBankManager($stub);
        $result           = $assetBankManager->syncAssetUsage($queryData);

        self::assertNotNull($result);
        self::assertEquals($result, []);
    }

    /**
     * Test if we call getCollections it will use the correct params for the request and returns successfully.
     *
     * @group collections
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getCollections()
     * @throws \Exception
     */
    public function testGetCollections()
    {
        $returnedCollections = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/collections/')
            ->willReturn($returnedCollections);

        $assetBankManager = new AssetBankManager($stub);
        $collectionList = $assetBankManager->getCollections();

        self::assertNotNull($collectionList);
        self::assertEquals($collectionList, $returnedCollections);


        // Test with query params.
        $query = [
            'count' => true,
            'limit' => 2,
            'type' => 'image'
        ];
        $stub->method('sendRequestAsync')
            ->with('GET', 'api/v4/collections/', ['query' => $query])
            ->willReturn($returnedCollections);

        $assetBankManager = new AssetBankManager($stub);
        $collectionList = $assetBankManager->getCollections($query);

        self::assertNotNull($collectionList);
        self::assertEquals($collectionList, $returnedCollections);

    }

    /**
     * Test if we call getCollections it will use the correct params for the request and returns successfully.
     *
     * @group collections
     *
     * @covers \Bynder\Api\Impl\AssetBankManager::getCollections()
     * @throws \Exception
     */
    public function testGetCollection()
    {
        $collectionId = 'ABCDEFGH';
        $returnedCollections = [];
        $stub = $this->getMockBuilder('Bynder\Api\Impl\OAuth2\RequestHandler')
            ->disableOriginalConstructor()
            ->getMock();

        $stub->method('sendRequestAsync')
            ->with('GET', "api/v4/collections/$collectionId/media/")
            ->willReturn($returnedCollections);

        $assetBankManager = new AssetBankManager($stub);
        $collectionList = $assetBankManager->getCollectionAssets($collectionId);

        self::assertNotNull($collectionList);
        self::assertEquals($collectionList, $returnedCollections);
    }
}
