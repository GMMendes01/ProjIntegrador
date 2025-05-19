<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Points - Leitor de Código de Barras</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2e7d32;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #388E3C;
        }
        #produtoInfo {
            margin-top: 30px;
            padding: 20px;
            background-color: #e8f5e9;
            border-radius: 8px;
            display: none;
        }
        #produtoImagem {
            max-width: 200px;
            max-height: 200px;
            display: block;
            margin: 10px 0;
            border-radius: 4px;
        }
        .error {
            color: #d32f2f;
            margin-top: 10px;
        }
        .points-badge {
            background-color: #2e7d32;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Eco Points</h1>
        <p>Registre produtos para reciclagem e ganhe pontos</p>
        
        <form id="produtoForm">
            <div class="form-group">
                <label for="codigoBarras">Código de Barras (EAN-13):</label>
                <input type="text" id="codigoBarras" name="codigoBarras" 
                       pattern="[0-9]{13}" title="Digite um código de 13 dígitos" required
                       placeholder="Ex: 7891234567890">
            </div>
            
            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" min="1" value="1" required>
            </div>
            
            <button type="button" id="buscarBtn">Buscar Produto</button>
            <div id="errorMsg" class="error"></div>
        </form>
        
        <div id="produtoInfo">
            <h2>Informações do Produto</h2>
            <img id="produtoImagem" src="" alt="Imagem do produto">
            <p><strong>Nome:</strong> <span id="produtoNome"></span></p>
            <p><strong>Marca:</strong> <span id="produtoMarca"></span></p>
            <p><strong>Embalagem:</strong> <span id="produtoEmbalagem"></span></p>
            <p><strong>Material Reciclável:</strong> <span id="produtoMaterial"></span></p>
            <p><strong>Pontos Eco:</strong> <span id="produtoPontos" class="points-badge"></span></p>
            
            <button type="button" id="registrarBtn" style="display: none;">Registrar Reciclagem</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buscarBtn = document.getElementById('buscarBtn');
            const registrarBtn = document.getElementById('registrarBtn');
            const errorMsg = document.getElementById('errorMsg');
            
            buscarBtn.addEventListener('click', buscarProduto);
            registrarBtn.addEventListener('click', registrarReciclagem);
            
            // Mapeamento de materiais para pontos
            const materiaisPontos = {
                'plástico': 50,
                'vidro': 40,
                'metal': 60,
                'papel': 30,
                'cartão': 25,
                'outros': 10
            };
            
            async function buscarProduto() {
                const codigoBarras = document.getElementById('codigoBarras').value;
                const quantidade = document.getElementById('quantidade').value;
                
                if (!codigoBarras || codigoBarras.length !== 13) {
                    showError('Por favor, insira um código de barras válido (13 dígitos)');
                    return;
                }
                
                try {
                    buscarBtn.disabled = true;
                    buscarBtn.textContent = 'Buscando...';
                    errorMsg.textContent = '';
                    
                    // Chamada para API Open Food Facts
                    const response = await fetch(`https://world.openfoodfacts.org/api/v0/product/${codigoBarras}.json`);
                    const data = await response.json();
                    
                    if (data.status === 1 && data.product) {
                        exibirProduto(data.product, quantidade);
                    } else {
                        showError('Produto não encontrado na base de dados. Você pode cadastrar manualmente.');
                    }
                } catch (error) {
                    console.error('Erro na API:', error);
                    showError('Erro ao consultar o produto. Tente novamente.');
                } finally {
                    buscarBtn.disabled = false;
                    buscarBtn.textContent = 'Buscar Produto';
                }
            }
            
            function exibirProduto(produto, quantidade) {
                const produtoInfo = document.getElementById('produtoInfo');
                const material = identificarMaterial(produto);
                const pontos = calcularPontos(material, quantidade);
                
                document.getElementById('produtoNome').textContent = produto.product_name || 'Nome não disponível';
                document.getElementById('produtoMarca').textContent = produto.brands || 'Marca não informada';
                document.getElementById('produtoEmbalagem').textContent = produto.packaging || 'Embalagem não especificada';
                document.getElementById('produtoMaterial').textContent = material;
                document.getElementById('produtoPontos').textContent = pontos;
                
                if (produto.image_url) {
                    document.getElementById('produtoImagem').src = produto.image_url;
                } else {
                    document.getElementById('produtoImagem').src = 'https://via.placeholder.com/200?text=Imagem+Não+Disponível';
                }
                
                produtoInfo.style.display = 'block';
                registrarBtn.style.display = 'inline-block';
            }
            
            function identificarMaterial(produto) {
                const packaging = (produto.packaging || '').toLowerCase();
                
                if (packaging.includes('plastic') || packaging.includes('plástico') || packaging.includes('pet')) {
                    return 'Plástico';
                } else if (packaging.includes('glass') || packaging.includes('vidro')) {
                    return 'Vidro';
                } else if (packaging.includes('metal') || packaging.includes('alumínio') || packaging.includes('aço')) {
                    return 'Metal';
                } else if (packaging.includes('paper') || packaging.includes('papel') || packaging.includes('cardboard')) {
                    return 'Papel';
                } else {
                    return 'Outros';
                }
            }
            
            function calcularPontos(material, quantidade) {
                const materialLower = material.toLowerCase();
                const pontosUnitarios = materiaisPontos[materialLower] || materiaisPontos['outros'];
                return pontosUnitarios * parseInt(quantidade);
            }
            
            function registrarReciclagem() {
                alert('Reciclagem registrada com sucesso! Pontos creditados na sua conta.');
                // Aqui você faria a chamada para seu backend para salvar os dados
                document.getElementById('produtoForm').reset();
                document.getElementById('produtoInfo').style.display = 'none';
                registrarBtn.style.display = 'none';
            }
            
            function showError(message) {
                errorMsg.textContent = message;
                document.getElementById('produtoInfo').style.display = 'none';
                registrarBtn.style.display = 'none';
            }
        });
    </script>
</body>
</html>