{{-- resources/views/autores/partials/form.blade.php --}}
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="Nome">Nome:</label>
            <input type="text" class="form-control" name="Nome" value="{{ old('Nome', $autor->Nome ?? '') }}" required>
        </div>
    </div>
</div>
