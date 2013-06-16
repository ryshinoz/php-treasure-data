<?php
namespace TreasureData\API;

use TreasureData\API;

class JobTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testResult()
    {
        // TODO 実際のレスンポンス後で確認
        $returnValues = array();
        $resutnValue1 = array(
            'id'   => 1,
            'name' => 'test'
        );
        $returnValues[] = json_encode($resutnValue1);
        $returnValue2 = array(
            'id'   => 2,
            'name' => 'test2'
        );
        $returnValues[] = json_encode($returnValue2);

        $mockJob = $this->getMock('Job', array('request'));
        $mockJob->expects($this->any())->method('request')->will($this->returnValue($returnValues));

        $id = 1;
        $format = 'json';
        $actual = $mockJob->request($id, $format);

        $this->assertThat(
            $actual,
            $this->equalTo($returnValues)
        );
    }
}
