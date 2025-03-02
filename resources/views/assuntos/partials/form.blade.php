{{-- resources/views/assuntos/partials/form.blade.php --}}
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="Descricao">Descrição:</label>
            <input type="text" class="form-control" name="Descricao" value="{{ old('Descricao', $assunto->Descricao ?? '') }}" required>
        </div>
    </div>
</div>
