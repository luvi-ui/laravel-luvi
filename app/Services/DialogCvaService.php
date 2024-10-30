<?php

namespace App\Services;

use FeatureNinja\Cva\ClassVarianceAuthority;

class DialogCvaService
{
    public static function new(): ClassVarianceAuthority
    {
        return ClassVarianceAuthority::new(
            [
                'transition ease-in-out [transition-behavior:allow-discrete] backdrop:bg-black/80 backdrop:duration-300 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:[transition-behavior:allow-discrete] open:backdrop:opacity-100 [@starting-style]:open:backdrop:opacity-0',
            ],
            [
                'variants' => [
                    'variant' => [
                        'dialog' => 'transition-[translate,opacity,scale,overlay,display] w-full max-w-lg border bg-background p-6 shadow-lg sm:rounded-lg open:animate-in animate-out',
                        'sheet' => 'open:grid grid-rows-[auto_1fr_auto] m-0 gap-4 bg-background p-6 shadow-lg transition-[display,overlay,transform] ease-in-out duration-500',
                    ],
                    'side' => [
                        'top' => 'max-w-full min-w-full overflow-x-auto !mb-auto border-b -translate-y-full open:translate-y-0 [@starting-style]:open:-translate-y-full',
                        'bottom' => 'max-w-full min-w-full overflow-x-auto !mt-auto border-t translate-y-full open:translate-y-0 [@starting-style]:open:translate-y-full',
                        'left' => 'max-h-dvh min-h-dvh overflow-y-auto !mr-auto w-3/4 border-r sm:max-w-sm -translate-x-full open:translate-x-0 [@starting-style]:open:-translate-x-full',
                        'right' => 'max-h-dvh min-h-dvh overflow-y-auto !ml-auto w-3/4 border-l sm:max-w-sm translate-x-full open:translate-x-0 [@starting-style]:open:translate-x-full',
                        'center' => 'open:fade-in-0 open:zoom-in-95 fade-out-0 zoom-out-95 ',
                    ],
                ],
                'defaultVariants' => [
                    'side' => 'center',
                    'variant' => 'dialog',
                ],
            ],
        );
    }
}
