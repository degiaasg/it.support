<?php

namespace App\Http\Controllers;

use App\Models\CompdLapt;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    private function getCategories(): array
    {
        return [
            'computing-devices' => [
                'label' => 'Computing Device',
                'items' => ['LAPTOP', 'NOTEBOOK', 'DESKTOP', 'PC', 'WORKSTATION', 'SERVER', 'MINI PC', 'NUC', 'ALL-IN-ONE PC', 'THIN CLIENT', 'ZERO CLIENT'],
            ],
            'mobile-devices' => [
                'label' => 'Mobile Devices',
                'items' => ['SMARTPHONE', 'TABLET', 'HANDHELD SCANNER', 'RUGGED DEVICE'],
            ],
            'networking-devices' => [
                'label' => 'Networking Devices',
                'items' => ['ROUTER', 'SWITCH MANAGED', 'SWITCH UNMANAGED', 'ACCESS POINT', 'FIREWALL', 'MODEM', 'LOAD BALANCER', 'WIRELESS CONTROLLER'],
            ],
            'storage-devices' => [
                'label' => 'Storage Devices',
                'items' => ['NAS (NETWORK ATTACHED STORAGE)', 'SAN (STORAGE AREA NETWORK)', 'EXTERNAL HDD/SSD', 'TAPE DRIVE / LIBRARY', 'FLASH DRIVE'],
            ],
            'peripheral-devices' => [
                'label' => 'Peripheral Devices',
                'items' => ['PRINTER', 'SCANNER', 'MONITOR DISPLAY', 'TV', 'PROJECTOR', 'UPS', 'DOCKING STATION', 'WEBCAM & CONFERENCE KIT', 'KEYBOARD', 'MOUSE'],
            ],
            'security-devices' => [
                'label' => 'Security Devices',
                'items' => ['IP CAMERA / CCTV', 'BIOMETRIC SCANNER', 'ACCESS CONTROL PANEL', 'HARDWARE SECURITY MODULE (HSM)', 'USB LOCK / PHYSICAL LOCK'],
            ],
            'telecommunication-devices' => [
                'label' => 'Telecommunication Devices',
                'items' => ['IP PHONE / VOIP', 'PBX SYSTEM', 'VIDEO CONFERENCE SYSTEM', 'INTERCOM SYSTEM', 'SERVER RACK', 'PDU (POWER DISTRIBUTION UNIT)', 'KVM SWITCH', 'COOLING SYSTEM', 'ENVIRONMENTAL SENSOR'],
            ],
            'data-center-infrastructure' => [
                'label' => 'Data Center Infrastructure',
                'items' => ['SERVER RACK', 'PDU (POWER DISTRIBUTION UNIT)', 'KVM SWITCH', 'COOLING SYSTEM', 'ENVIRONMENTAL SENSOR'],
            ],
        ];
    }

    public function category(string $slug)
    {
        $categories = $this->getCategories();

        if (!isset($categories[$slug])) {
            abort(404);
        }

        $category = $categories[$slug];

        $items = [];
        foreach ($category['items'] as $name) {
            if ($name === 'LAPTOP') {
                $total = CompdLapt::count();
                $available = CompdLapt::where('status', 'IN STORE')->count();
                $inUse = CompdLapt::where('status', 'IN USE')->count();
                $maintenance = CompdLapt::where('status', 'IN REPAIR')->count();
            } else {
                $total = rand(1, 50);
                $available = rand(0, (int) ceil($total * 0.5));
                $inUse = rand(0, $total - $available);
                $inUse = min($inUse, $total - $available);
                $maintenance = $total - $available - $inUse;
            }

            $items[] = [
                'name' => $name,
                'total' => $total,
                'available' => $available,
                'in_use' => $inUse,
                'maintenance' => $maintenance,
            ];
        }

        return view('assets.category', compact('category', 'items', 'slug'));
    }

    public function item(string $slug, string $itemSlug)
    {
        $categories = $this->getCategories();

        if (!isset($categories[$slug])) {
            abort(404);
        }

        $itemName = null;
        foreach ($categories[$slug]['items'] as $name) {
            if (Str::slug($name) === $itemSlug) {
                $itemName = $name;
                break;
            }
        }

        if (!$itemName) {
            abort(404);
        }

        if ($itemName === 'LAPTOP') {
            $assets = CompdLapt::orderBy('id_lapt')->paginate(15);
            return view('assets.item', compact('assets', 'slug', 'itemName'));
        }

        return view('assets.item', [
            'assets' => collect([]),
            'slug' => $slug,
            'itemName' => $itemName,
        ]);
    }
}
