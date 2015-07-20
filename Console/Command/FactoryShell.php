<?php

App::uses('HttpSocket', 'Network/Http');

class FactoryShell extends AppShell {

    public $uses = array('Factory');
    public $types = array(
        '01' => '股份有限公司',
        '02' => '有限公司',
        '03' => '無限公司',
        '04' => '兩合公司',
        '05' => '合夥',
        '06' => '獨資',
        '07' => '外國公司認許',
        '08' => '外國公司報備',
        '09' => '本國公司之分公司',
        '10' => '外國公司之分公司',
        '11' => '合作社',
        '12' => '農會組織',
        '13' => '公營',
        '14' => '漁會',
        '15' => '大陸公司許可登記',
        '16' => '大陸公司許可報備',
        '17' => '大陸公司之分公司',
        '99' => '其他',
    );
    public $status = array(
        '00' => '生產中',
        '01' => '停工',
        '02' => '歇業',
        '03' => '設立未登記',
        '04' => '公告註銷',
        '05' => '設立許可逾期失效',
        '06' => '設立許可註銷',
        '07' => '設立許可撤銷',
        '08' => '設立許可廢止',
        '09' => '歇業-遷廠',
        '10' => '歇業-產業類別變更',
        '11' => '歇業-關廠',
        '12' => '校正後廢止',
        '13' => '勒令停工-工業主管機關',
        '14' => '勒令停工-勞工主管機關',
        '16' => '勒令停工-消防主管機關',
        '17' => '勒令停工-其他',
    );
    public $cities = array(
        '630' => '臺北市',
        '10017' => '基隆市',
        '650' => '新北市',
        '10002' => '宜蘭縣',
        '10004' => '新竹縣',
        '10018' => '新竹市',
        '10003' => '桃園縣',
        '10005' => '苗栗縣',
        '660' => '臺中市',
        '10007' => '彰化縣',
        '10008' => '南投縣',
        '10020' => '嘉義市',
        '10010' => '嘉義縣',
        '10009' => '雲林縣',
        '670' => '臺南市',
        '640' => '高雄市',
        '10016' => '澎湖縣',
        '10013' => '屏東縣',
        '10014' => '臺東縣',
        '10015' => '花蓮縣',
        '09020' => '金門縣',
        '09007' => '連江縣',
    );

    public function main() {
        $this->parseOpendata();
    }

    /*
     * the file downloaded from http://data.gov.tw/node/6569
     * http://www.cto.moea.gov.tw/04/factory.zip
     */

    public function parseOpendata() {
        if (!file_exists(TMP . 'factory')) {
            mkdir(TMP . 'factory', 0777, true);
            $zip = new ZipArchive();
            $res = $zip->open(__DIR__ . '/data/factory.zip');
            if ($res === TRUE) {
                $zip->extractTo(TMP . 'factory');
                $zip->close();
            }
        }
        $xml = new XMLReader();
        $counter = 0;
        $headers = array(
            '工廠名稱',
            '工廠登記編號',
            '工廠設立許可案號',
            '工廠地址',
            '工廠市鎮鄉村里',
            '工廠負責人姓名',
            '營利事業統一編號',
            '工廠組織型態',
            '工廠設立核准日期',
            '工廠登記核准日期',
            '工廠登記狀態',
            '產業類別',
            '主要產品',
        );
        /*
         * empty field
         * Array
          (
          [工廠名稱] => 1
          [工廠登記編號] => 1
          [工廠設立許可案號] => 0
          [工廠地址] => 0
          [工廠市鎮鄉村里] => 1
          [工廠負責人姓名] => 1
          [營利事業統一編號] => 0
          [工廠組織型態] => 0
          [工廠設立核准日期] => 0
          [工廠登記核准日期] => 1
          [工廠登記狀態] => 1
          [產業類別] => 0
          [主要產品] => 0
          )
         * 
         * max length
         * Array
          (
          [工廠名稱] => 90          name
          [工廠登記編號] => 8        id
          [工廠設立許可案號] => 14    license_no
          [工廠地址] => 1110        address
          [工廠市鎮鄉村里] => 30     cunli
          [工廠負責人姓名] => 36      owner
          [營利事業統一編號] => 9     company_id
          [工廠組織型態] => 24       type
          [工廠設立核准日期] => 7     date_approved
          [工廠登記核准日期] => 7     date_registered
          [工廠登記狀態] => 9        status
          [產業類別] => 362          * tags
          [主要產品] => 593          * tags
          )
         */
        $cat1 = $cat2 = array();
        foreach (glob(TMP . 'factory/*.xml') AS $xmlFile) {
            $xml->open($xmlFile);
            while ($xml->read()) {
                if ($xml->nodeType === XMLReader::ELEMENT && $xml->name === 'ROW') {
                    $row = (array) simplexml_load_string($xml->readOuterXml(), 'SimpleXMLElement', LIBXML_NOCDATA);
                    foreach ($row['COLUMN'] AS $k => $v) {
                        $row['COLUMN'][$k] = is_string($v) ? $v : '';
                    }
                    $data = array(
                        'Factory' => array(
                            'id' => $row['COLUMN'][1],
                            'name' => $row['COLUMN'][0],
                            'license_no' => $row['COLUMN'][2],
                            'address' => $row['COLUMN'][3],
                            'cunli' => $row['COLUMN'][4],
                            'owner' => $row['COLUMN'][5],
                            'company_id' => $row['COLUMN'][6],
                            'type' => $row['COLUMN'][7],
                            'date_approved' => $this->getTwDate($row['COLUMN'][8]),
                            'date_registered' => $this->getTwDate($row['COLUMN'][8]),
                            'status' => $row['COLUMN'][10],
                        ),
                        'Tag' => array(),
                    );
                    if (!empty($row['COLUMN'][11])) {
                        $row['COLUMN'][11] = explode(',', $row['COLUMN'][11]);
                        foreach ($row['COLUMN'][11] AS $cat) {
                            $code = substr($cat, 0, 2);
                            if (!isset($cat1[$code])) {
                                $this->Factory->Tag->create();
                                $this->Factory->Tag->save(array('Tag' => array(
                                        'name' => $cat,
                                )));
                                $cat1[$code] = $this->Factory->Tag->getInsertID();
                            }
                        }
                    }
                    if (!empty($row['COLUMN'][12])) {
                        $row['COLUMN'][12] = explode(',', $row['COLUMN'][12]);

                        foreach ($row['COLUMN'][12] AS $cat) {
                            $code = substr($cat, 0, 3);
                            $parentCode = substr($cat, 0, 2);
                            if (!isset($cat2[$code])) {
                                $this->Factory->Tag->create();
                                $this->Factory->Tag->save(array('Tag' => array(
                                        'parent_id' => $cat1[$parentCode],
                                        'name' => $cat,
                                )));
                                $cat2[$code] = $this->Factory->Tag->getInsertID();
                            }
                            $data['Tag'][] = $cat2[$code];
                        }
                    }
                    $this->Factory->create();
                    $this->Factory->save($data);
                }
            }
        }
    }

    public function getTwDate($str) {
        if (empty($str)) {
            return '';
        }
        $parts = array(
            substr($str, 0, 3),
            substr($str, 3, 2),
            substr($str, 5, 2),
        );
        $parts[0] = intval($parts[0]) + 1911;
        return implode('-', $parts);
    }

    public function parseFactories() {
        $target = __DIR__ . '/data';
        $HttpSocket = new HttpSocket();
        foreach ($this->cities AS $cityCode => $cityName) {
            foreach ($this->types AS $typeCode => $typeName) {
                foreach ($this->status AS $statusCode => $statusName) {
                    $listFile = "{$target}/lists/{$cityCode}/{$typeCode}_{$statusCode}.csv";
                    if (file_exists($listFile) && filesize($listFile) > 0) {
                        echo "processing lists/{$cityCode}/{$typeCode}_{$statusCode}.csv\n";
                        $fh = fopen($listFile, 'r');
                        while ($line = fgetcsv($fh, 2048)) {
                            /*
                             * $line = array(id, name, link)
                             */
                            $output = "{$target}/details/" . substr($line[0], 0, 2) . '/' . substr($line[0], 2, 2);
                            if (!file_exists($output)) {
                                mkdir($output, 0777, true);
                            }
                            $output .= '/' . $line[0] . '.json';
                            if (!file_exists($output)) {
                                $c = mb_convert_encoding(file_get_contents($line[2]), 'utf8', 'big5');
                                $data = array(
                                    '工廠名稱' => $line[1],
                                    '原始資料網址' => $line[2],
                                );
                                $pos = strpos($c, '<table', strpos($c, '<font color="#333399" size="2">'));
                                $posEnd = strpos($c, '</table>', $pos);
                                $lines = explode('</tr>', substr($c, $pos, $posEnd - $pos));
                                foreach ($lines AS $line) {
                                    $cols = explode('</td>', $line);
                                    foreach ($cols AS $k => $v) {
                                        $cols[$k] = trim(strip_tags($v));
                                    }
                                    switch (count($cols)) {
                                        case 5:
                                            $data[$cols[2]] = $cols[3];
                                        case 3:
                                            $data[$cols[0]] = $cols[1];
                                            break;
                                    }
                                }
                                $pos = strpos($c, '<font size="2">產業類別</font>', $posEnd);
                                $posEnd = strpos($c, '</table>', $pos);
                                $lines = explode('</tr>', substr($c, $pos, $posEnd - $pos));
                                $lines[0] = trim(strip_tags($lines[0]));
                                $lines[2] = trim(strip_tags($lines[2]));
                                $areas = explode('<BR>', $lines[1]);
                                foreach ($areas AS $k => $v) {
                                    $v = trim(strip_tags($v));
                                    unset($areas[$k]);
                                    if (!empty($v)) {
                                        $vLines = explode("\n", $v);
                                        if (isset($vLines[1])) {
                                            $areas[trim($vLines[0])] = trim($vLines[1]);
                                        }
                                    }
                                }
                                $products = explode('<BR>', $lines[3]);
                                foreach ($products AS $k => $v) {
                                    $v = trim(strip_tags($v));
                                    unset($products[$k]);
                                    if (!empty($v)) {
                                        $vLines = explode("\n", $v);
                                        if (isset($vLines[1])) {
                                            $products[trim($vLines[0])] = trim($vLines[1]);
                                        }
                                    }
                                }
                                $data[$lines[0]] = $areas;
                                $data[$lines[2]] = $products;
                                file_put_contents($output, json_encode($data));
                            }
                        }
                    }
                }
            }
        }
    }

    public function getPageLinks($c) {
        $result = array();
        $pos = strpos($c, '<td width="30%" class="td_lightyellow">');
        while (false !== $pos) {
            $posEnd = strpos($c, '</tr>', $pos);
            $line = substr($c, $pos, $posEnd - $pos);
            $linkPos = strpos($line, '?method=detail');
            $link = substr($line, $linkPos, strpos($line, '"', $linkPos) - $linkPos);
            $lines = explode("\n", strip_tags($line));
            $result[] = array(
                'id' => trim($lines[0]),
                'name' => trim($lines[1]),
                'link' => 'http://gcis.nat.gov.tw/Fidbweb/factInfoAction.do' . $link,
            );
            $pos = strpos($c, '<td width="30%" class="td_lightyellow">', $posEnd);
        }
        return $result;
    }

    public function postForm() {
        $target = __DIR__ . '/data';
        $HttpSocket = new HttpSocket();
        foreach ($this->cities AS $cityCode => $cityName) {
            foreach ($this->types AS $typeCode => $typeName) {
                foreach ($this->status AS $statusCode => $statusName) {
                    if (!file_exists("{$target}/lists/{$cityCode}")) {
                        mkdir("{$target}/lists/{$cityCode}", 0777, true);
                    }
                    if (!file_exists("{$target}/lists/{$cityCode}/{$typeCode}_{$statusCode}.csv")) {
                        echo "processing lists/{$cityCode}/{$typeCode}_{$statusCode}.csv\n";
                        $h = fopen("{$target}/lists/{$cityCode}/{$typeCode}_{$statusCode}.csv", 'w');
                        $firstPage = $HttpSocket->post(
                                'http://gcis.nat.gov.tw/Fidbweb/factInfoListAction.do', array(
                            'method' => 'query',
                            'regiID' => '',
                            'estbID' => '',
                            'factName' => '',
                            'addrCityCode1' => 'JJ',
                            'addrCityCode2' => 'JJ',
                            'factAddr' => '',
                            'orgCode' => $typeCode, //$types
                            'statCode' => $statusCode, //$status
                            'cityCode1' => $cityCode, //$cities
                            'cityCode2' => 'JJ',
                            'profItem' => 'JJ',
                            'prodItem' => '',
                            'prodItemCode' => '',
                            'isFoodAdditionVal' => '',
                            'profItemValue' => '',
                            'tmp_profitem' => 'JJ'
                                )
                        );
                        $firstPage = mb_convert_encoding($firstPage, 'utf8', 'big5');
                        $pos = strpos($firstPage, '共找到') + strlen('共找到');
                        $records = intval(substr($firstPage, $pos, strpos($firstPage, '筆', $pos) - $pos));
                        if ($records > 0) {
                            $links = $this->getPageLinks($firstPage);
                            foreach ($links AS $link) {
                                fputcsv($h, $link);
                            }
                            $pages = floor($records / 10);
                            if ($records % 10 !== 0) {
                                $pages += 1;
                            }
                            if ($pages > 1) {
                                $pos = strpos($firstPage, ';jsessionid=') + 12;
                                $sessKey = substr($firstPage, $pos, strpos($firstPage, '"', $pos) - $pos);
                                for ($i = 2; $i <= $pages; $i ++) {
                                    $results = $HttpSocket->post(
                                            'http://gcis.nat.gov.tw/Fidbweb/factInfoListAction.do;jsessionid=' . $sessKey, array(
                                        'method' => 'goPage',
                                        'goPage' => $i,
                                            )
                                    );
                                    $links = $this->getPageLinks(mb_convert_encoding($results, 'utf8', 'big5'));
                                    foreach ($links AS $link) {
                                        fputcsv($h, $link);
                                    }
                                }
                            }
                        }
                        fclose($h);
                    }
                }
            }
        }
    }

}
