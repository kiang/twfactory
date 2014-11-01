<?php

App::uses('HttpSocket', 'Network/Http');

class FactoryShell extends AppShell {

    public function main() {
        $this->postForm();
    }

    public function parseFactories() {
        $pool = TMP . 'factory';
        $oFh = fopen($pool . '/factories.csv', 'w');
        fputcsv($oFh, array(
            '公司（營利事業）統一編號',
            '工廠登記編號',
            '工廠名稱',
            '工廠地址',
        ));
        foreach (glob($pool . '/factory_*') AS $factoryFile) {
            $c = file_get_contents($factoryFile);
            $pos = strpos($c, '<font color="#333399" size="2">');
            $data = array(
                '工廠名稱' => trim(strip_tags(substr($c, $pos, strpos($c, '</font>', $pos) - $pos))),
            );
            $pos = strpos($c, '<table', $pos);
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
                    $areas[trim($vLines[0])] = trim($vLines[1]);
                }
            }
            $products = explode('<BR>', $lines[3]);
            foreach ($products AS $k => $v) {
                $v = trim(strip_tags($v));
                unset($products[$k]);
                if (!empty($v)) {
                    $vLines = explode("\n", $v);
                    $products[trim($vLines[0])] = trim($vLines[1]);
                }
            }
            $data[$lines[0]] = $areas;
            $data[$lines[2]] = $products;
            fputcsv($oFh, array(
                $data['公司（營利事業）統一編號'],
                $data['工廠登記編號'],
                $data['工廠名稱'],
                $data['工廠地址'],
            ));
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
        $types = array(
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
        $status = array(
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
        $cities = array(
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
        $pool = TMP . 'factory';
        $target = __DIR__ . '/data';
        $HttpSocket = new HttpSocket();
        if (!file_exists($pool)) {
            mkdir($pool, 0777, true);
        }
        if (!file_exists($target)) {
            mkdir($target, 0777, true);
        }
        foreach ($cities AS $cityCode => $cityName) {
            foreach ($types AS $typeCode => $typeName) {
                foreach ($status AS $statusCode => $statusName) {
                    if (!file_exists("{$target}/lists/{$cityCode}")) {
                        mkdir("{$target}/lists/{$cityCode}", 0777, true);
                    }
                    if (!file_exists("{$target}/lists/{$cityCode}/{$typeCode}_{$statusCode}.csv")) {
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
