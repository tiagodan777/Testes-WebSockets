<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebSockets</title>
</head>
<body>
    <h2>Chat</h2>

    <label for="mensagem">Nova mensagem:</label>
    <input type="text" name="mensagem" id="mensagem" placeholder="Escreve uma mensagem">
    <br><br>

    <input type="button" value="Enviar" onclick="enviar()">
    <br><br>

    <span id="mensagem-chat"></span>

    <script>
        const menssagemChat = window.document.getElementById('mensagem-chat')

        const ws = new WebSocket('ws://localhost:8080')

        ws.onopen = (e) => {
            console.log('Conectado!')
        }

        ws.onmessage = (mensagemRecebida) => {
            let resultado = JSON.parse(mensagemRecebida.data)

            menssagemChat.insertAdjacentHTML('beforeend', `${resultado.mensagem} <br>`)
        }

        const enviar = () => {
            let mensagem = window.document.getElementById('mensagem')

            let dados = {
                mensagem: mensagem.value
            }

            ws.send(JSON.stringify(dados))

            menssagemChat.insertAdjacentHTML('beforeend', `${mensagem.value} <br>`)

            mensagem.value = ''
        }
    </script>
</body>
</html>