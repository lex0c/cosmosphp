<?php

namespace Cosmos\Debug;

use \Symfony\Component\VarDumper\Cloner\VarCloner;
use \Symfony\Component\VarDumper\Dumper\CliDumper;
use \Cosmos\Debug\Resources\CosmosHTMLDumper;

class Debugger
{
    /**
     * This is var_dump with steroids :p
     *
     * @param  mixed  $data
     * @param  bool   $superDump
     *
     * @return void
     */
    public function varDump($data, bool $superDump = true)
    {
        if($superDump) {
            $dumper = 'cli' === PHP_SAPI ? new CliDumper : new CosmosHTMLDumper;
            $dumper->dump((new VarCloner)->cloneVar($data));
        } else {
            var_dump($data);
        }
    }
}
