<div id="vimprimir" class="container">
    
    <div class="row p-2 border border-primary">
        <div class="col">
            <x-jet-application-mark />
        </div>
    </div>
    <div class="row p-2">
        <div class="col">
            <h3>RUT : 26 231 106 - 8</h3>
        </div>
        <div class="col"><h3>I.V.A. REGIMEN SIMPLIFICADO</h3></div>
    </div>
    <div class="row p-2">
        <div class="col" align="center">
            <H2>REPRESENTANTE LEGAL JANETH DIAZ LLORENTE</H2>
        </div>
    </div>
    <div class="row p-2">
        <div class="col" align="center">
            <H2>Cra. 19 D N° 62-36 Sur B. San Francisco Tel. 716 9768 Bogotá D.C.-Colombia</H2>
        </div>
    </div>
    <div class="row p-2">
        <div class="col" >
            <H2>No. Factura : {{ $factura[0]->id }}</H2>
        </div>
    </div>
    <div class="row p-2">
        <div class="col" >
            <H2>Fecha : {{ now() }}</H2>
        </div>
    </div>
    <div class="row p-2">
        <div class="col" >
            <H2>Cliente : {{ $factura[0]->cliente->prinom . ' ' . $factura[0]->cliente->segnom . ' ' . $factura[0]->cliente->priape . ' ' . $factura[0]->cliente->segape }}</H2>
        </div>
    </div>
    <div class="row p-2">
        <div class="col" >
            <H2>Teléfono : {{ $factura[0]->cliente->celular }}</H2>
        </div>
    </div>
    <div class="row p-2">
        <div class="col" >
            
        </div>
        <div class="col-6" align="right">
            <H2>Valor Total</H2>
            <H2>Abono</H2>
            <H2>Saldo</H2>
            <H2>Fecha Entrega</H2>
        </div>
        <div class="col" align="right">
            <H2>{{ '$ ' . number_format($factura[0]->total) }}</H2>
            <H2>{{ '$ ' . number_format($factura[0]->abono) }}</H2>
            <H2>{{ '$ ' . number_format($factura[0]->total - $factura[0]->abono) }}</H2>
            <H2>{{ date_format($factura[0]->created_at,"d/m/Y") }}</H2>
        </div>
    </div>
    
</div>