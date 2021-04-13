<?php

use App\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = new Package();
        $package->code = 'PDA';
        $package->name = 'PAQ. DIAGNOSTICO BASICO A (RXPA.+RXPE.+8FOTOS )';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PPF';
        $package->name = 'PAQ. PANORÁMICA Y FOTOS';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PDC';
        $package->name = 'PAQ. DIAGNOSTICO BASICO  COMPLETO (RXPA.+RXPE.+FOTOS/MODELOS+TRAZO)';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PPF1';
        $package->name = 'PAQ. PANORAMICA Y FOTOS PAPEL';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PPF2';
        $package->name = 'PAQ. PANORAMICA Y FOTOS VIRTUAL';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PDAP';
        $package->name = 'PAQ. DIAGNOSTICO BASICO A (RXPA.+RXPE.+8FOTOS ) PAPEL';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PDAVT';
        $package->name = 'PAQ. DIAGNOSTICO BASICO A (RXPA.+RXPE.+8FOTOS ) VIRTUAL';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PDB';
        $package->name = 'PAQ. DIAGNOSTICO BASICO B (RXPA.+RXPE.+MODELOS)';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PDBVT';
        $package->name = 'PAQ. DIAGNOSTICO BASICO B (RXPA.+RXPE.+MODELOS)VIRTUAL';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'POP';
        $package->name = 'PAQ. ORTODONCIA COMPLETO (RXPA.+ RXPE+ 8FOTOS + MOD.E/T + TRAZO CEF.) PAPEL';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'POVT';
        $package->name = 'PAQ. ORTODONCIA COMPLETO (RXPA.+ RXPE+ 8FOTOS + MOD.E/T + TRAZO CEF.) VIRTUAL';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PR';
        $package->name = 'PAQ. REHABILITACION (RXPA.+ RXPERIAPICAL COMPLETO + MODELOS DE TRABAJO + 5FOTOS)';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PP';
        $package->name = 'PAQ. PERIODONCIA (RXPERIAP. COMPLETO+ 5FOTOS INTRAORALES)';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PM';
        $package->name = 'PAQ. MAXILOFACIAL (RXPA.+ RXPE. + RXAP. + 14FOTOS + MOD. EST.)';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PI';
        $package->name = 'PAQ. IMPLANTOLOGIA (RXPA.+ RXPERIAP.COMPLETO+MOD. TRAB. +5FOTOS)';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PO';
        $package->name = 'PAQ. ORTODONCIA COMPLETO (RXPA.+ RXPE+ 8FOTOS + MOD.E/T + TRAZO CEF.)';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'POSM';
        $package->name = 'PAQ. ORTODONCIA COMPLETO (RXPA.+ RXPE+ 8FOTOS + TRAZO CEF.)';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'POSPVT';
        $package->name = 'PAQ.ORT. SIN PAN. RX DENT PREVIA (PERFIL.+MOD.EST. Ó TRAB.+8FOTOS-TRAZO) VIRTUAL';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'POSP';
        $package->name = 'PAQ.ORT. SIN PAN. RX DENT PREVIA (PERFIL.+MOD.EST. Ó TRAB.+8FOTOS-TRAZO)';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PDCVT';
        $package->name = 'PAQ. DIAGNOSTICO BASICO  COMPLETO (RXPA.+RXPE.+FOTOS/MODELOS+TRAZO) -VIRTUAL';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'PDCSP';
        $package->name = 'PAQ. DIAGNOSTICO COMPLETO SIN PANORAMICA';
        $package->is_active = '1';
        $package->save();

        $package = new Package();
        $package->code = 'RPEF';
        $package->name = 'PAQ. PERFIL Y FOTO';
        $package->is_active = '1';
        $package->save();


    }
}
