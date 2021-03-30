<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $product = New Product;
        $product->cod_manager = 'F1';
        $product->name = 'CD (CON FOTOS, RX Y MATERIAL DIGITAL)';
        $product->radiation_dose_type = '0';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'CRRP01';
        $product->name = 'COPIA (PANORAMICA, ATM, SENOS M.)';
        $product->radiation_dose_type = '0';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'CRRPE';
        $product->name = 'COPIA (PERFIL-AP-CARPO.)';
        $product->radiation_dose_type = '0';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'CRR12';
        $product->name = 'COPIA (PERIAPICAL,OCLUSAL,MILIMETRADA,CORONAL)';
        $product->radiation_dose_type = '0';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'CF';
        $product->name = 'COPIA FOTOS';
        $product->radiation_dose_type = '0';
        $product->station = 'fotos';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'CR';
        $product->name = 'COPIA RX';
        $product->radiation_dose_type = '0';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'F2';
        $product->name = 'FOTOGRAFIA EN CD';
        $product->radiation_dose_type = '0';
        $product->station = 'fotos';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'F3';
        $product->name = 'FOTOGRAFIA INDIVIDUAL';
        $product->radiation_dose_type = '0';
        $product->station = 'fotos';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'F4';
        $product->name = 'FOTOGRAFIA X 5 FOTOS';
        $product->radiation_dose_type = '0';
        $product->station = 'fotos';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'F5';
        $product->name = 'FOTOGRAFIA X 8 FOTOS';
        $product->radiation_dose_type = '0';
        $product->station = 'fotos';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'F5VT';
        $product->name = 'FOTOGRAFIA X 8 FOTOS VIRTUAL';
        $product->radiation_dose_type = '0';
        $product->station = 'fotos';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'F6';
        $product->name = 'FOTOGRAFIAX 8 FOTOS PAPEL';
        $product->radiation_dose_type = '0';
        $product->station = 'fotos';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'F7';
        $product->name = 'FOTOGRAFÍA 1:1 (25.5*20) 2 O MENOS FOTOS';
        $product->radiation_dose_type = '0';
        $product->station = 'fotos';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'LECT';
        $product->name = 'LECTURA';
        $product->radiation_dose_type = '0';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'LR';
        $product->name = 'LECTURA POR RADIOLOGO';
        $product->radiation_dose_type = '0';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'M1';
        $product->name = 'MODELOS DE ESTUDIO';
        $product->radiation_dose_type = '0';
        $product->station = 'laboratorio';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'M2';
        $product->name = 'MODELOS DE TRABAJO';
        $product->radiation_dose_type = '0';
        $product->station = 'laboratorio';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'M3';
        $product->name = 'MODELOS DE TRABAJO (DOBLE VACIADO)';
        $product->radiation_dose_type = '0';
        $product->station = 'laboratorio';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'M4';
        $product->name = 'MODELOS PARA MONTAR (1TOMA SUP. O INF.)';
        $product->radiation_dose_type = '0';
        $product->station = 'laboratorio';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'M5';
        $product->name = 'MODELOS SIN MONTAR (1TOMA SUP. O INF.)';
        $product->radiation_dose_type = '0';
        $product->station = 'laboratorio';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PPF';
        $product->name = 'PANORAMICA Y FOTOS';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PPF1';
        $product->name = 'PANORAMICA Y FOTOS PAPEL';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PPF2';
        $product->name = 'PANORAMICA Y FOTOS VIRTUAL';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PDC';
        $product->name = 'PAQ. DIAGNOSTICO BASICO  COMPLETO (RXPA.+RXPE.+FOTOS/MODELOS+TRAZO)';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PDCVT';
        $product->name = 'PAQ. DIAGNOSTICO BASICO  COMPLETO (RXPA.+RXPE.+FOTOS/MODELOS+TRAZO) -VIRTUAL';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PDA';
        $product->name = 'PAQ. DIAGNOSTICO BASICO A (RXPA.+RXPE.+8FOTOS )';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PDAP';
        $product->name = 'PAQ. DIAGNOSTICO BASICO A (RXPA.+RXPE.+8FOTOS ) PAPEL';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PDAVT';
        $product->name = 'PAQ. DIAGNOSTICO BASICO A (RXPA.+RXPE.+8FOTOS ) VIRTUAL';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PDB';
        $product->name = 'PAQ. DIAGNOSTICO BASICO B (RXPA.+RXPE.+MODELOS)';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PDBVT';
        $product->name = 'PAQ. DIAGNOSTICO BASICO B (RXPA.+RXPE.+MODELOS)VIRTUAL';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PDCSP';
        $product->name = 'PAQ. DIAGNOSTICO COMPLETO SIN PANORAMICA';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PI';
        $product->name = 'PAQ. IMPLANTOLOGIA (RXPA.+ RXPERIAP.COMPLETO+MOD. TRAB. +5FOTOS)';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PM';
        $product->name = 'PAQ. MAXILOFACIAL (RXPA.+ RXPE. + RXAP. + 14FOTOS + MOD. EST.)';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PO';
        $product->name = 'PAQ. ORTODONCIA COMPLETO (RXPA.+ RXPE+ 8FOTOS + MOD.E/T + TRAZO CEF.)';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'POP';
        $product->name = 'PAQ. ORTODONCIA COMPLETO (RXPA.+ RXPE+ 8FOTOS + MOD.E/T + TRAZO CEF.) PAPEL';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'POVT';
        $product->name = 'PAQ. ORTODONCIA COMPLETO (RXPA.+ RXPE+ 8FOTOS + MOD.E/T + TRAZO CEF.) VIRTUAL';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'POSM';
        $product->name = 'PAQ. ORTODONCIA COMPLETO (RXPA.+ RXPE+ 8FOTOS + TRAZO CEF.)';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PP';
        $product->name = 'PAQ. PERIODONCIA (RXPERIAP. COMPLETO+ 5FOTOS INTRAORALES)';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'PR';
        $product->name = 'PAQ. REHABILITACION (RXPA.+ RXPERIAPICAL COMPLETO + MODELOS DE TRABAJO + 5FOTOS)';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'POSP';
        $product->name = 'PAQ.ORT. SIN PAN. RX DENT PREVIA (PERFIL.+MOD.EST. Ó TRAB.+8FOTOS-TRAZO)';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'POSPVT';
        $product->name = 'PAQ.ORT. SIN PAN. RX DENT PREVIA (PERFIL.+MOD.EST. Ó TRAB.+8FOTOS-TRAZO) VIRTUAL';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'RPEF';
        $product->name = 'PERFIL Y FOTO';
        $product->radiation_dose_type = '0';
        $product->is_package = '1';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R16A';
        $product->name = 'PERIAPICAL ADICIONAL';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R3';
        $product->name = 'RX AP O PA';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R5';
        $product->name = 'RX ATM VISTA FRONTAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R5VT';
        $product->name = 'RX ATM VISTA FRONTAL-VIRTUAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R4';
        $product->name = 'RX CARPOGRAMA';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R7';
        $product->name = 'RX CORONAL COMPLETO DIGITAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R7VT';
        $product->name = 'RX CORONAL COMPLETO VIRTUAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R8';
        $product->name = 'RX CORONAL DIGITAL (1 A 4)';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R8VT';
        $product->name = 'RX CORONAL DIGITAL VIRTUAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R9';
        $product->name = 'RX OCLUSAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R9VT';
        $product->name = 'RX OCLUSAL VIRTUAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'RP1';
        $product->name = 'RX PANORAMICA DIGITAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'RP01';
        $product->name = 'RX PANORAMICA DIGITAL CON PERIAPICALES (2 HASTA 4)';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'RP03';
        $product->name = 'RX PANORAMICA PAPEL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'RP02';
        $product->name = 'RX PANORAMICA VIRTUAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'RPE';
        $product->name = 'RX PERFIL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'RPE01';
        $product->name = 'RX PERFIL PAPEL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'REP02';
        $product->name = 'RX PERFIL VIRTUAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R11';
        $product->name = 'RX PERIAPICAL COMPLETO (14 PLACAS)ANALOGO';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R15';
        $product->name = 'RX PERIAPICAL COMPLETO DIGITAL (HASTA 14)';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R15VT';
        $product->name = 'RX PERIAPICAL COMPLETO DIGITAL (HASTA 14) VIRTUAL';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R14';
        $product->name = 'RX PERIAPICAL MEDIO DIGITAL (5 O HASTA 7)';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R14VT';
        $product->name = 'RX PERIAPICAL MEDIO DIGITAL VIRTUAL (5 O HASTA 7)';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R16';
        $product->name = 'RX PERIAPICAL MILIMETRADA';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R10';
        $product->name = 'RX PERIAPICAL PARCIAL  ANALOGA';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R12';
        $product->name = 'RX PERIAPICAL PARCIAL DIGITAL';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R13';
        $product->name = 'RX PERIAPICAL PARCIAL DIGITAL (3 O HASTA 4)';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R12VT';
        $product->name = 'RX PERIAPICAL PARCIAL DIGITAL VIRTUAL';
        $product->radiation_dose_type = '1';
        $product->station = 'periapical';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'R6';
        $product->name = 'RX SENOS MAXILARES VISTA FRONTAL';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'TR5';
        $product->name = 'TOMOGRAFIA ATM';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'TC';
        $product->name = 'TOMOGRAFIA COMPLETA';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'TMI';
        $product->name = 'TOMOGRAFIA DE MAXILAR INFERIOR';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'TMS';
        $product->name = 'TOMOGRAFIA DE MAXILAR SUPERIOR';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'TDI';
        $product->name = 'TOMOGRAFIA DIENTE INCLUIDO';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'TH';
        $product->name = 'TOMOGRAFIA HEMIARCADA';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'TSP';
        $product->name = 'TOMOGRAFIA SENOS PARANASALES';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'TM1';
        $product->name = 'TOMOGRAFRIA DE 1 A 3 ZONAS';
        $product->radiation_dose_type = '2';
        $product->station = 'rayos-x';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'T1';
        $product->name = 'TRAZO CEFALOMETRICO';
        $product->radiation_dose_type = '0';
        $product->station = 'fotos';
        $product->is_package = '0';
        $product->save();

        $product = New Product;
        $product->cod_manager = 'WT';
        $product->name = 'WATTERS';
        $product->radiation_dose_type = '0';
        $product->is_package = '0';
        $product->save();
    }
}
