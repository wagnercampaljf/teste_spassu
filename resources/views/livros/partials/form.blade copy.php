{{-- resources/views/livros/partials/form.blade.php --}}

<div class="row mb-3">
    <div class="col-12">
        <div class="form-group">
            <label for="Titulo">Título:</label>
            <input type="text" class="form-control" name="Titulo" value="{{ old('Titulo', $livro->Titulo ?? '') }}" required>
        </div>
    </div>
</div>

<div class="row  mb-3">
    <div class="col-6">
        <div class="form-group">
            <label for="Editora">Editora:</label>
            <input type="text" class="form-control" name="Editora" value="{{ old('Editora', $livro->Editora ?? '') }}" required>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="Edicao">Edição:</label>
            <input type="number" class="form-control" name="Edicao" value="{{ old('Edicao', $livro->Edicao ?? '') }}" required>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="AnoPublicacao">Ano de Publicação:</label>
            <input type="number" class="form-control" name="AnoPublicacao" value="{{ old('AnoPublicacao', $livro->AnoPublicacao ?? '') }}" required>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-6">
        <div class="form-group">
            <label for="autores">Autores:</label>
            <select name="autores[]" class="form-control" multiple>
                @foreach($autores as $autor)
                    <option value="{{ $autor->id }}" {{ (isset($livro) && $livro->autores->pluck('id')->contains($autor->id)) ? 'selected' : '' }}>
                        {{ $autor->nome }}
                    </option>
                @endforeach
            </select>
            <select id="select-tom" multiple>
                <option value="1">Opção 1</option>
                <option value="2">Opção 2</option>
                <option value="3">Opção 3</option>
            </select>
            <script>
                new TomSelect("#select-tom", {
                    create: true,
                    sortField: "text",
                });
            </script>
        </div>
    </div>
    <div class="col-6">
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
    </div>
</div>