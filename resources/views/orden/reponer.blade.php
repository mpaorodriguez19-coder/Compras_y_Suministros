@extends('layouts.app')
@section('title','Orden - Reponer')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center mb-4">Orden de Compra - Reponer</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form id="ordenForm" method="POST" action="{{ route('orden.store') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="fecha" class="form-label"><strong>Fecha:</strong></label>
                        <input type="date" name="fecha" id="fecha" class="form-control"
                               value="{{ old('fecha', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label"><strong>Proveedor:</strong></label>
                        <div class="input-group">
                            <select name="proveedor_id" id="proveedor_id" class="form-control">
                                <option value="">-- Proveedor --</option>
                                @foreach($proveedores as $p)
                                    <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-outline-secondary"
                                    onclick="window.open('{{ url('/proveedores') }}','_blank')">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"><strong>Lugar:</strong></label>
                        <input type="text" name="lugar" id="lugar" class="form-control"
                               value="{{ old('lugar') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label"><strong>N°</strong></label>
                        <input type="text" name="numero" class="form-control"
                               value="{{ old('numero', $numero ?? '') }}" readonly>
                    </div>
                </div>

                {{-- TABLA --}}
                <div class="table-responsive">
                    <table class="table table-bordered align-middle" id="itemsTable">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width:6%;">Cant.</th>
                                <th>Descripción</th>
                                <th style="width:10%;">Unidad</th>
                                <th style="width:12%;">Precio Unitario</th>
                                <th style="width:12%;">Descuento</th>
                                <th style="width:12%;">Valor L.</th>
                                <th style="width:6%;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="number" min="0" step="0.01" class="form-control qty"
                                           name="items[0][cantidad]" value="1"></td>
                                <td><input type="text" class="form-control desc"
                                           name="items[0][descripcion]" placeholder="Descripción del artículo"></td>
                                <td><input type="text" class="form-control unidad"
                                           name="items[0][unidad]"></td>
                                <td><input type="number" min="0" step="0.01" class="form-control price"
                                           name="items[0][precio_unitario]" value="0.00"></td>
                                <td><input type="number" min="
