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
        $returnValue =<<< EOD
["560309","s"]
["198368","p"]
["560309","s"]
["607222","s"]
["198368","p"]
["607222","s"]
EOD;

        $mockJob = $this->getMockBuilder('\TreasureData\API\Job')->setMethods(array('request'))->disableOriginalConstructor()->getMock();
        $mockJob->expects($this->any())->method('request')->will($this->returnValue($returnValue));

        $id = 1;
        $format = 'json';
        $actual = $mockJob->result($id, $format);

        $expect = array(
            array('560309', 's'),
            array('198368', 'p'),
            array('560309', 's'),
            array('607222', 's'),
            array('198368', 'p'),
            array('607222', 's'),
        );

        $this->assertThat(
            $actual,
            $this->equalTo($expect)
        );
    }
}
