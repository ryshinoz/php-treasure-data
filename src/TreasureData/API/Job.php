<?php
/**
 *  Job.php
 *
 *  @package    TreasureData
 *  @author     Sotaro KARASAWA <sotarok@crocos.co.jp>
 *  @license    Apache License 2.0
 */

namespace TreasureData\API;

use TreasureData\Exception;
use TreasureData\API\Base;

/**
 *  TreasureData\API\Job
 *
 *  @package    TreasureData
 *  @author     Sotaro KARASAWA <sotarok@crocos.co.jp>
 *  @license    Apache License 2.0
 */
class Job extends Base
{
    const PATH = 'job';

    public function issue($query, $type = 'hive')
    {
        $path = sprintf('issue/%s/%s', $type, $this->getDbName());

        $result = $this->request($path, array('query' => $query), true);
        $json = json_decode($result);
        if (!$json->job_id) {
            throw new Exception("Failed to job issued: result='$result'");
        }

        return $json->job_id;
    }

    public function show($id)
    {
        $path = sprintf('show/%s', $id);

        $result = $this->request($path);
        $json = json_decode($result);
        if (!$json->job_id) {
            $msg = !empty($json->message) ? $json->message : $result;
            throw new Exception("Failed to show: $msg");
        }

        return $json;
    }

    public function result($id, $format = 'json')
    {
        $path = sprintf('result/%s', $id);

        $result = $this->request($path, array('format' => $format));

        if ($format == 'json') {
            $json = '[' . str_replace("]\n[", "],[", trim($result)) . ']';
            return json_decode($json);
        }
        return $result;
    }
}
