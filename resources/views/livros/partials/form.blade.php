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
    <div class="col-2">
        <div class="form-group">
            <label for="Edicao">Edição:</label>
            <input type="number" class="form-control" name="Edicao" value="{{ old('Edicao', $livro->Edicao ?? '') }}" required>
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label for="AnoPublicacao">Ano Publicação:</label>
            <input 
                type="number" 
                class="form-control" 
                name="AnoPublicacao" 
                value="{{ old('AnoPublicacao', $livro->AnoPublicacao ?? '') }}" 
                required
                min="-2000" max="2099" 
                step="1"
                oninput="this.value = this.value.slice(0, 4);">
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label for="Valor">Valor:</label>
            <input type="text" class="form-control" name="Valor" value="{{ old('Valor', $livro->Valor ?? '') }}" required  onkeyup="formatarMoeda(this)">
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-6">
        <div class="form-group">
            <label for="autores">Autores:</label>
            <select name="Autores[]" class="form-control" id="select-autores" multiple>
                @foreach($autores as $autor)
                    <option value="{{ $autor->CodAu }}" {{ (isset($livro) && $livro->autores->pluck('CodAu')->contains($autor->CodAu)) ? 'selected' : '' }}>
                        {{ $autor->Nome }}
                    </option>
                @endforeach
            </select>
            <script>
                new TomSelect("#select-autores", {
                    create: true,
                    sortField: "text",
                });
            </script>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="assuntos">Assuntos:</label>
            <select name="Assuntos[]" class="form-control" id="select-assuntos" multiple>
                @foreach($assuntos as $assunto)
                    <option value="{{ $assunto->CodAs }}" {{ (isset($livro) && $livro->assuntos->pluck('CodAs')->contains($assunto->CodAs)) ? 'selected' : '' }}>
                        {{ $assunto->Descricao }}
                    </option>
                @endforeach
            </select>
            <script>
                new TomSelect("#select-assuntos", {
                    create: true,
                    sortField: "text",
                });
            </script>
        </div>
    </div>
</div>

<script>
    function formatarMoeda(input) {
        let valor = input.value;

        // Remove caracteres não numéricos, exceto ponto e vírgula
        valor = valor.replace(/\D/g, "");

        // Converte para número, divide por 100 para obter decimais
        valor = (parseFloat(valor) / 100).toFixed(2);

        // Formata como moeda (BRL)
        valor = valor.replace(".", ",");

        // Adiciona símbolo de moeda
        input.value = "R$ " + valor;
    }
</script>