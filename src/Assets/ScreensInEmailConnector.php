<?php

namespace ProcessMaker\Packages\Connectors\Email\Assets;

use DOMXPath;
use Log;
use ProcessMaker\Managers\ExportManager;
use ProcessMaker\Models\Process;
use ProcessMaker\Models\Screen;
use ProcessMaker\Providers\WorkflowServiceProvider;

class ScreensInEmailConnector
{

    public $type = Screen::class;
    public $owner = Process::class;

    /**
     * Get screens references used in a process
     *
     * @param Process $process
     * @param array $screens
     *
     * @return array
     */
    public function referencesToExport(Process $process, array $references = [])
    {
        // Screens used in BPMN
        $xpath = new DOMXPath($process->getDefinitions());
        $xpath->registerNamespace('pm', WorkflowServiceProvider::PROCESS_MAKER_NS);

        // Nodes whose implementation are part of this connector
        $nodes = $xpath->query("//*[@implementation='connector-send-email/processmaker-communication-email-send']");

        foreach ($nodes as $node) {
            $config = json_decode($node->getAttributeNS(WorkflowServiceProvider::PROCESS_MAKER_NS, 'config'));
            if (isset($config->screenRef) && is_numeric($config->screenRef)) {
                $references[] = [Screen::class, $config->screenRef];
            }
        }

        return $references;
    }

    /**
     * Update references used in an imported process
     *
     * @param Process $process
     * @param array $references
     * @param ExportManager $exportManager
     *
     * @return void
     */
    public function updateReferences(Process $process, array $references = [], ExportManager $exportManager = null)
    {
        $definitions = $process->getDefinitions();
        $xpath = new DOMXPath($definitions);
        $xpath->registerNamespace('pm', WorkflowServiceProvider::PROCESS_MAKER_NS);

        // Nodes whose implementation are part of this connector
        $nodes = $xpath->query("//*[@implementation='connector-send-email/processmaker-communication-email-send']");

        foreach ($nodes as $node) {
            $config = json_decode($node->getAttributeNS(WorkflowServiceProvider::PROCESS_MAKER_NS, 'config'));
            if (isset($config->screenRef) && is_numeric($config->screenRef)) {
                $oldRef = $config->screenRef;
                if (isset($references[Screen::class][$oldRef])) {
                    $newRef = $references[Screen::class][$oldRef]->getKey();
                } else {
                    $newRef = null;
                }
                if ($config->type === 'screen' && !$newRef && $exportManager) {
                    $exportManager->addLogMessage(
                        'processmaker-communication-email-send:references',
                        __('Imported file does not contain the screen assigned to an email connector'),
                        false,
                        __('Configuration Send Email')
                    );
                }
                $config->screenRef = $newRef;
                $node->setAttributeNS(WorkflowServiceProvider::PROCESS_MAKER_NS, 'config', json_encode($config));
            }
        }

        $process->bpmn = $definitions->saveXML();
        $process->save();
    }
}
