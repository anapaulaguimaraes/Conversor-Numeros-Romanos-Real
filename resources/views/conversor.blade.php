<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Número Romano e Real</title>
    <link rel="stylesheet" href="{{ asset('css/conversor.css') }}">
</head>

<body>
    <div class="container">
        <h1 class="titulo">Conversor de Número Romano e Real</h1>
        <div class="conversor">
            <!-- Formulário para converter número real para romano -->
            <div class="formulario-conversao">
                <form action="{{ url('/converte-romano') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="real">Número Real para Romano:</label>
                        <input type="number" id="real" name="real" placeholder="Digite um número Real " required>
                        <button type="submit" class="btn">Converter</button>
                    </div>
                </form>
            </div>

            <!-- Formulário para converter número romano para real -->
            <div class="formulario-conversao">
                <form action="{{ url('/converte-real') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="romano">Número Romano para Real:</label>
                        <input type="text" id="romano" name="romano" placeholder="Digite um número Romano" required>
                        <button type="submit" class="btn">Converter</button>
                    </div>
                </form>
            </div>

            <!-- Mostrar resultado -->
            @if(isset($resultado))
            <div class="resultado">
                <h3>Resultado:</h3>
                <div class="resultado-group">
                    <p>{{ $resultado }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</body>

</html>