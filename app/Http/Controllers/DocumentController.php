<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected function getDocuments(): array
    {
        return [
            'forms' => ['label' => 'Forms', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            'boq' => ['label' => 'Bill of Quantity', 'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            'iom' => ['label' => 'IOM', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            'spk' => ['label' => 'SPK', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            'wpr' => ['label' => 'WPR', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            'po' => ['label' => 'PO', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            'bast' => ['label' => 'BAST', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ];
    }

    public function index(string $type)
    {
        $documents = $this->getDocuments();

        if (!array_key_exists($type, $documents)) {
            abort(404);
        }

        $title = $documents[$type]['label'];
        return view('documents.index', compact('type', 'title'));
    }

    public function bast(string $category, string $item)
    {
        $documents = $this->getDocuments();
        $title = $documents['bast']['label'];
        $items = [
            'computing-devices' => ['LAPTOP', 'NOTEBOOK', 'DESKTOP', 'PC', 'WORKSTATION', 'SERVER', 'MINI PC', 'NUC', 'ALL-IN-ONE PC', 'THIN CLIENT', 'ZERO CLIENT'],
            'mobile-devices' => ['SMARTPHONE', 'TABLET', 'HANDHELD SCANNER', 'RUGGED DEVICE'],
            'networking-devices' => ['ROUTER', 'SWITCH MANAGED', 'SWITCH UNMANAGED', 'ACCESS POINT', 'FIREWALL', 'MODEM', 'LOAD BALANCER', 'WIRELESS CONTROLLER'],
            'storage-devices' => ['NAS (NETWORK ATTACHED STORAGE)', 'SAN (STORAGE AREA NETWORK)', 'EXTERNAL HDD/SSD', 'TAPE DRIVE / LIBRARY', 'FLASH DRIVE'],
            'peripheral-devices' => ['PRINTER', 'SCANNER', 'MONITOR DISPLAY', 'TV', 'PROJECTOR', 'UPS', 'DOCKING STATION', 'WEBCAM & CONFERENCE KIT', 'KEYBOARD', 'MOUSE'],
            'security-devices' => ['IP CAMERA / CCTV', 'BIOMETRIC SCANNER', 'ACCESS CONTROL PANEL', 'HARDWARE SECURITY MODULE (HSM)', 'USB LOCK / PHYSICAL LOCK'],
            'telecommunication-devices' => ['IP PHONE / VOIP', 'PBX SYSTEM', 'VIDEO CONFERENCE SYSTEM', 'INTERCOM SYSTEM', 'SERVER RACK', 'PDU (POWER DISTRIBUTION UNIT)', 'KVM SWITCH', 'COOLING SYSTEM', 'ENVIRONMENTAL SENSOR'],
            'data-center-infrastructure' => ['SERVER RACK', 'PDU (POWER DISTRIBUTION UNIT)', 'KVM SWITCH', 'COOLING SYSTEM', 'ENVIRONMENTAL SENSOR'],
        ];

        if (!isset($items[$category]) || !in_array(strtoupper($item), $items[$category])) {
            abort(404);
        }

        $itemName = strtoupper(str_replace('-', ' ', $item));
        return view('documents.bast', compact('title', 'category', 'item', 'itemName'));
    }
}
