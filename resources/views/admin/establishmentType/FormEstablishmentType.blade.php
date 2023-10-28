@csrf

{{-- name --}}
<div class="col-lg-12 mb-2">
    <div class="form-group">
        <label for="name" class="col-form-label">Nombre</label>
        <input type="text" name="name" id="name" placeholder="Nombre del tipo de establecimiento"
            class="form-control" value="{{ old('name', $establishmentType) }}">
    </div>

    @error('name')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

{{-- state --}}
<div class="col-lg-12 mb-2">
    <label class="form-label" for="state">Estado</label>
    <select class="form-select col-sm-12" id="state" name="state">
        <option value="">Escoger estado...</option>
        <option value="true"
            @isset($establishmentType)
                    {{ $establishmentType->state == true ? 'selected' : '' }}
                @endisset>
            Activado</option>

        <option value="false"
            @isset($establishmentType)
                    {{ $establishmentType->state == false ? 'selected' : '' }}
                @endisset>
            Desactivado</option>
    </select>

    @error('state')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>
