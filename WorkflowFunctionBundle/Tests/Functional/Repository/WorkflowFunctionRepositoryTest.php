<?php

namespace OpenOrchestra\WorkflowFunctionBundle\Tests\Functional\Repository;

use OpenOrchestra\ModelInterface\Repository\Configuration\FinderConfiguration;
use OpenOrchestra\ModelInterface\Repository\Configuration\PaginateFinderConfiguration;
use OpenOrchestra\WorkflowFunction\Repository\WorkflowFunctionRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class WorkflowFunctionRepositoryTest
 */
class WorkflowFunctionRepositoryTest extends KernelTestCase
{
    /**
     * @var WorkflowFunctionRepositoryInterface
     */
    protected $repository;

    /**
     * Set up test
     */
    protected function setUp()
    {
        parent::setUp();

        static::bootKernel();
        $this->repository = static::$kernel->getContainer()->get('open_orchestra_workflow_function.repository.workflow_function');
    }

    /**
     * @param array  $descriptionEntity
     * @param array  $columns
     * @param string $search
     * @param int    $skip
     * @param int    $limit
     * @param int    $count
     *
     * @dataProvider providePaginateAndSearch
     */
    public function testFindForPaginate($descriptionEntity, $columns, $search, $skip, $limit, $count)
    {
        $configuration = new PaginateFinderConfiguration();
        $configuration->setSearch($search);
        $configuration->setDescriptionEntity($descriptionEntity);
        $configuration->setColumns($columns);
        $configuration->setSkip($skip);
        $configuration->setLimit($limit);
        $worflowFunctions = $this->repository->findForPaginate($configuration);
        $this->assertCount($count, $worflowFunctions);
    }

    /**
     * @return array
     */
    public function providePaginateAndSearch()
    {
        $descriptionEntity = $this->getDescriptionColumnEntity();

        return array(
            array($descriptionEntity, $this->generateColumnsProvider(), null, 0 ,5 , 2),
            array($descriptionEntity, $this->generateColumnsProvider('validator'), null, 0 ,5 , 1),
            array($descriptionEntity, $this->generateColumnsProvider('contributor'), null, 0 ,5 , 1),
            array($descriptionEntity, $this->generateColumnsProvider('fakeName'), null, 0 ,5 , 0),
            array($descriptionEntity, $this->generateColumnsProvider(), 'validator',  0 ,5 , 1),
        );
    }

    /**
     * test count all workflow function
     */
    public function testCount()
    {
        $worflowFunctions = $this->repository->count();
        $this->assertEquals(2, $worflowFunctions);
    }

    /**
     * @param array  $columns
     * @param array  $descriptionEntity
     * @param string $search
     * @param int    $count
     *
     * @dataProvider provideColumnsAndSearchAndCount
     */
    public function testCountWithSearchFilter($descriptionEntity, $columns, $search, $count)
    {
        $configuration = new FinderConfiguration();
        $configuration->setDescriptionEntity($descriptionEntity);
        $configuration->setColumns($columns);
        $configuration->setSearch($search);
        $worflowFunctions = $this->repository->countWithFilter($configuration);
        $this->assertEquals($count, $worflowFunctions);
    }

    /**
     * @return array
     */
    public function provideColumnsAndSearchAndCount()
    {
        $descriptionEntity = $this->getDescriptionColumnEntity();

        return array(
            array($descriptionEntity, $this->generateColumnsProvider(), null, 2),
            array($descriptionEntity, $this->generateColumnsProvider('validator'), null, 1),
            array($descriptionEntity, $this->generateColumnsProvider('contributor'), null, 1),
            array($descriptionEntity, $this->generateColumnsProvider('fakeName'), null, 0),
            array($descriptionEntity, $this->generateColumnsProvider(), 'validator', 1),
        );
    }

    /**
     * Generate columns of content with search value
     *
     * @param string $searchName
     *
     * @return array
     */
    protected function generateColumnsProvider($searchName = '')
    {
        return array(
            array('name' => 'name', 'searchable' => true, 'orderable' => true, 'search' => array('value' => $searchName)),
        );
    }

    /**
     * Generate relation between columns names and entities attributes
     *
     * @return array
     */
    protected function getDescriptionColumnEntity()
    {
        return array(
            'name' => array('key' => 'name'),
        );
    }

}
