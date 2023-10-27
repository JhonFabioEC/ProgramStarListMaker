@csrf

{{-- name --}}
<div class="col-lg-12">
    <div class="form-group">
        <label for="name" class="col-form-label">Nombre</label>
        <input type="text" name="name" id="name" placeholder="Nombre de la marca"
            class="form-control" value="{{ old('name', $brand) }}">
    </div>

    @error('name')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

{{-- state --}}
<div class="col-lg-12">
    <label for="state" class="ml-3 col-sm-3 col-form-label">Estado</label>
    <div class="col-sm-12">
        <select class="form-select col-sm-12" id="state" name="state">
            <option value="">Escoger estado...</option>
            <option value="true"
                @isset($brand)
                    {{ $brand->state == true ? 'selected' : '' }}
                @endisset
            >Activado</option>

            <option value="false"
                @isset($brand)
                    {{ $brand->state == false ? 'selected' : '' }}
                @endisset
            >Desactivado</option>
        </select>
    </div>

    @error('state')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>
