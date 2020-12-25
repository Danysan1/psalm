<?php
namespace Psalm\Report;

use LSS\Array2XML;
use Psalm\Report;
use Psalm\Internal\Analyzer\IssueData;
use function array_map;

class XmlReport extends Report
{
    public function create(): string
    {
        $content = [
                'item' => array_map(
                    function (IssueData $issue_data): array {
                        $issue_data = (array) $issue_data;
                        unset($issue_data['dupe_key']);
                        return $issue_data;
                    },
                    $this->issues_data
                )
            ];

        echo json_encode($content).PHP_EOL;
        
        $xml = Array2XML::createXML('report', $content);

        return $xml->saveXML();
    }
}
