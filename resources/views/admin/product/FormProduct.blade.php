@csrf

{{-- name --}}
<div class="col-lg-12 mb-2">
    <div class="form-group">
        <label for="name" class="col-form-label">Nombre</label>
        <input type="text" name="name" id="name" placeholder="Nombre del producto" class="form-control"
            value="{{ old('name', $product) }}">
    </div>

    @error('name')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

{{-- price --}}
<div class="col-lg-12 mb-2">
    <div class="form-group">
        <label for="price" class="col-form-label">Precio</label>
        <input type="number" name="price" id="price" placeholder="Precio" class="form-control"
            value="{{ old('price', $product) }}">
    </div>

    @error('price')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

{{-- stock --}}
<div class="col-lg-12 mb-2">
    <div class="form-group">
        <label for="stock" class="col-form-label">Cantidad</label>
        <input type="number" name="stock" id="stock" placeholder="Cantidad" class="form-control"
            value="{{ old('stock', $product) }}">
    </div>

    @error('stock')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

{{-- barcode --}}
<div class="col-lg-12 mb-2">
    <div class="form-group">
        <label for="barcode" class="col-form-label">Codigo de barras</label>
        <input type="number" name="barcode" id="barcode" placeholder="Codigo de barras" class="form-control"
            value="{{ old('barcode', $product) }}">
    </div>

    @error('barcode')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- category -->
<div class="col-lg-12 mb-2">
    <label class="col-form-label" for="category_id">Categoría</label>
    <select class="form-select col-sm-12" name="category_id" id="category_id">
        <option value="">Seleccione una categoría</option>

        @isset($categories)
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @isset($product)
                        @selected(old('category_id', $product) == $product->category->id)
                    @endisset>
                    {{ $category->name }} </option>
            @endforeach
        @endisset
    </select>

    @error('category_id')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- brand -->
<div class="col-lg-12 mb-2">
    <label class="col-form-label" for="brand_id">Marca</label>
    <select class="form-select col-sm-12" name="brand_id" id="brand_id">
        <option value="">Seleccione una marca</option>

        @isset($brands)
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}"
                    @isset($product)
                        @selected(old('brand_id', $product) == $product->brand->id)
                    @endisset>
                    {{ $brand->name }} </option>
            @endforeach
        @endisset
    </select>

    @error('brand_id')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

{{-- section --}}
<div class="col-lg-12 mb-2">
    <div class="form-group">
        <label for="section" class="col-form-label">Seccion</label>
        <input type="text" name="section" id="section" placeholder="Seccion" class="form-control"
            value="{{ old('section', $product) }}">
    </div>

    @error('section')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

{{-- description --}}
<div class="col-lg-12 mb-2">
    <div class="form-group">
        <label for="description" class="col-form-label">Descripcion</label>
        <textarea name="description" id="description" placeholder="Descripcion" class="form-control" cols="30"
            rows="4">{{ old('description', $product) }}</textarea>
    </div>

    @error('description')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

{{-- state --}}
<div class="col-lg-12 mb-2">
    <label class="col-form-label" for="state">Estado</label>
    <select class="form-select col-sm-12" id="state" name="state">
        <option value="">Escoger estado...</option>
        <option value="true"
            @isset($product)
                    {{ $product->state == true ? 'selected' : '' }}
                @endisset>
            Activado</option>

        <option value="false"
            @isset($product)
                    {{ $product->state == false ? 'selected' : '' }}
                @endisset>
            Desactivado</option>
    </select>

    @error('state')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- image -->
<div class="col-lg-12 mb-2">
    <label for="customFile" class="col-form-label">Imagen</label>
    <div class="custom-file">
        <input type="file" class="form-control custom-file-input" name="image" id="customFile"
            placeholder="Selecciona una imagen" value="{{ old('image', $product) }}">
        <label class="custom-file-label" for="customFile">Seleccionar</label>
    </div>
    @error('image')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="col-lg-12 mb-2 d-flex justify-content-center">
    <img name="image" id="preview-image-before-upload"
        src="@isset($product)
            {{ asset('storage/products/' . $product->image) }}
        @else
            {{ asset('img/upload-image.png') }}
        @endisset"
        alt="Previsualizar imagen" class="image-preview">
</div>
