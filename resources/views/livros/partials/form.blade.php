{{-- resources/views/livros/partials/form.blade.php --}}
<div class="form-group">
    <label for="Titulo">Título:</label>
    <input type="text" class="form-control" name="Titulo" value="{{ old('Titulo', $livro->Titulo ?? '') }}" required>
</div>

<div class="form-group">
    <label for="Editora">Editora:</label>
    <input type="number" class="form-control" name="Editora" value="{{ old('Editora', $livro->Editora ?? '') }}" required>
</div>

<div class="form-group">
    <label for="Edicao">Edição:</label>
    <input type="number" class="form-control" name="Edicao" value="{{ old('Edicao', $livro->Edicao ?? '') }}" required>
</div>

<div class="form-group">
    <label for="AnoPublicacao">Ano de Publicação:</label>
    <input type="number" class="form-control" name="AnoPublicacao" value="{{ old('AnoPublicacao', $livro->AnoPublicacao ?? '') }}" required>
</div>

<div class="form-group">
    <label for="autores">Autores:</label>
    <select name="autores[]" class="form-control" multiple>
        @foreach($autores as $autor)
            <option value="{{ $autor->id }}" {{ (isset($livro) && $livro->autores->pluck('id')->contains($autor->id)) ? 'selected' : '' }}>
                {{ $autor->nome }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="assuntos">Assuntos:</label>
    <select name="assuntos[]" class="form-control" multiple>
        @foreach($assuntos as $assunto)
            <option value="{{ $assunto->id }}" {{ (isset($livro) && $livro->assuntos->pluck('id')->contains($assunto->id)) ? 'selected' : '' }}>
                {{ $assunto->nome }}
            </option>
        @endforeach
    </select>
</div>
