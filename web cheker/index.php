<?php
// Configuración para Replit
error_reporting(0);
ignore_user_abort(true);
date_default_timezone_set('UTC');

// Función para validar cookies (ejemplo)
function validateAmazonCookie($cookie) {
    return strpos($cookie, 'session-id') !== false;
}

// Si es solicitud API
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    // Verificar si es para validar cookies
    if (isset($_POST['validate_cookies'])) {
        $results = [];
        $cookies = json_decode($_POST['cookies'], true);

        foreach ($cookies as $cookie) {
            $isValid = validateAmazonCookie($cookie);
            $results[] = [
                'cookie' => $cookie,
                'valid' => $isValid,
                'message' => $isValid ? 'Cookie válida' : 'Cookie inválida'
            ];
        }

        echo json_encode(['results' => $results]);
        exit;
    }

    // Validación normal de tarjetas
    $input = json_decode(file_get_contents('php://input'), true);
    $results = [];
    
    foreach ($input['cards'] as $cardData) {
        $lista = $cardData['lista'] ?? '';
        $cookie = $cardData['cookie'] ?? '';
        
        // Simular validación (reemplazar con tu lógica real)
        $isValid = (rand(0, 1) === 1); // Ejemplo aleatorio
        
        $results[] = [
            'card' => $lista,
            'cookie' => $cookie,
            'status' => $isValid ? 'live' : 'dead',
            'raw_response' => $isValid ? 
                'Tarjeta válida - Cookies now detected' : 
                'Tarjeta inválida - Cookies not detected'
        ];
    }
    
    echo json_encode(['results' => $results]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validador de Tarjetas y Cookies</title>
    <style>
        :root {
            --live: #28a745;
            --dead: #dc3545;
            --cookie-ok: #17a2b8;
            --cookie-error: #ffc107;
            --invalid: #6c757d;
            --error: #6f42c1;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        .section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
        }
        h1, h2 {
            color: #343a40;
            margin-top: 0;
        }
        textarea {
            width: 100%;
            min-height: 100px;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            margin-bottom: 15px;
            font-family: monospace;
        }
        .btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-block {
            display: block;
            width: 100%;
        }
        .result-container {
            margin-top: 20px;
        }
        .card-result, .cookie-result {
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
            border-left: 4px solid;
            background-color: rgba(0,0,0,0.03);
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 12px;
            margin-right: 8px;
            color: white;
        }
        .badge-live { background: var(--live); }
        .badge-dead { background: var(--dead); }
        .badge-cookie-ok { background: var(--cookie-ok); }
        .badge-cookie-error { background: var(--cookie-error); color: #000; }
        .badge-invalid { background: var(--invalid); }
        .badge-error { background: var(--error); }
        .raw-response {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 4px;
            font-family: monospace;
            font-size: 13px;
            white-space: pre-wrap;
            border: 1px solid #eee;
        }
        .progress-container {
            margin: 15px 0;
        }
        .progress-bar {
            height: 6px;
            background: #007bff;
            width: 0%;
            border-radius: 4px;
            transition: width 0.3s;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        .tab:hover {
            background-color: #f8f9fa;
        }
        .tab.active {
            border-bottom-color: #007bff;
            font-weight: bold;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .cookie-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background: white;
            padding: 25px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }
        .modal-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        .modal-buttons button {
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        #useCookieBtn {
            background: #28a745;
            color: white;
            border: none;
        }
        #cancelCookieBtn {
            background: #dc3545;
            color: white;
            border: none;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            background: #2c3e50;
            color: white;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .summary-item {
            text-align: center;
            flex: 1;
        }
        .summary-count {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Validador de Tarjetas y Cookies</h1>
        
        <div class="tabs">
            <div class="tab active" onclick="switchTab('cards')">Validar Tarjetas</div>
            <div class="tab" onclick="switchTab('cookies')">Validar Cookies</div>
        </div>
        
        <!-- Sección de Tarjetas -->
        <div id="cards-tab" class="tab-content active">
            <div class="section">
                <h2>Validación de Tarjetas</h2>
                <p>Ingrese las tarjetas en formato: <code>Número|Mes|Año|CVV</code> (una por línea)</p>
                <textarea id="cardsInput" placeholder="4111111111111111|12|2025|123
5555555555554444|03|2024|456"></textarea>
                <button id="validateCardsBtn" class="btn btn-block">Validar Tarjetas</button>
                
                <div class="progress-container" id="cardsProgress" style="display: none;">
                    <div class="progress-bar" id="cardsProgressBar"></div>
                    <div id="cardsProgressText">0%</div>
                </div>
                
                <div id="cardsSummary" class="summary" style="display: none;">
                    <div class="summary-item">
                        <div class="summary-count" id="cardsTotal">0</div>
                        <div>Total</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-count" id="cardsLive">0</div>
                        <div>Vivas</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-count" id="cardsDead">0</div>
                        <div>Muertas</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-count" id="cardsError">0</div>
                        <div>Errores</div>
                    </div>
                </div>
                
                <div class="result-container" id="cardsResults"></div>
            </div>
        </div>
        
        <!-- Sección de Cookies -->
        <div id="cookies-tab" class="tab-content">
            <div class="section">
                <h2>Validación de Cookies</h2>
                <p>Ingrese las cookies de Amazon (una por línea):</p>
                <textarea id="cookiesInput" placeholder="session-id=123...
session-id-time=123456789..."></textarea>
                <button id="validateCookiesBtn" class="btn btn-block">Validar Cookies</button>
                
                <div class="progress-container" id="cookiesProgress" style="display: none;">
                    <div class="progress-bar" id="cookiesProgressBar"></div>
                    <div id="cookiesProgressText">0%</div>
                </div>
                
                <div id="cookiesSummary" class="summary" style="display: none;">
                    <div class="summary-item">
                        <div class="summary-count" id="cookiesTotal">0</div>
                        <div>Total</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-count" id="cookiesValid">0</div>
                        <div>Válidas</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-count" id="cookiesInvalid">0</div>
                        <div>Inválidas</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-count" id="cookiesError">0</div>
                        <div>Errores</div>
                    </div>
                </div>
                
                <div class="result-container" id="cookiesResults"></div>
            </div>
        </div>
    </div>

    <script>
        // ========== CONFIGURACIÓN ========== //
        const API_ENDPOINT = window.location.href;
        const REQUEST_DELAY = 200; // ms entre peticiones
        
        // ========== FUNCIONES DE INTERFAZ ========== //
        
        function switchTab(tabName) {
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            
            document.querySelector(`.tab[onclick="switchTab('${tabName}')"]`).classList.add('active');
            document.getElementById(`${tabName}-tab`).classList.add('active');
        }
        
        function toggleRawResponse(element) {
            const rawDiv = element.nextElementSibling;
            rawDiv.style.display = rawDiv.style.display === 'block' ? 'none' : 'block';
            element.textContent = rawDiv.style.display === 'block' ? '▲ Ocultar detalles' : '▼ Mostrar detalles';
        }
        
        async function showCookieModal() {
            return new Promise((resolve) => {
                const modal = document.createElement('div');
                modal.className = 'cookie-modal';
                modal.innerHTML = `
                    <div class="modal-content">
                        <h3>Ingrese Cookie para Validación</h3>
                        <textarea id="globalCookieInput" placeholder="session-id=123...; ubid-main=ABC..."></textarea>
                        <div class="modal-buttons">
                            <button id="useCookieBtn">Usar Cookie</button>
                            <button id="cancelCookieBtn">Validar sin Cookie</button>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
        
                document.getElementById('useCookieBtn').addEventListener('click', () => {
                    const cookie = document.getElementById('globalCookieInput').value.trim();
                    document.body.removeChild(modal);
                    resolve(cookie);
                });
                
                document.getElementById('cancelCookieBtn').addEventListener('click', () => {
                    document.body.removeChild(modal);
                    resolve('');
                });
            });
        }
        
        // ========== FUNCIONES DE VALIDACIÓN ========== //
        
        async function makeApiRequest(url, options) {
            try {
                const response = await fetch(url, options);
                
                // Verificar si la respuesta es JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    throw new Error(`La respuesta no es JSON: ${text.substring(0, 100)}${text.length > 100 ? '...' : ''}`);
                }
                
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                
                return await response.json();
            } catch (error) {
                console.error('Error en la petición:', error);
                throw error;
            }
        }
        
        async function validateCardWithCookie(cardData, cookie = '') {
            try {
                const response = await makeApiRequest(API_ENDPOINT, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ 
                        cards: [{ 
                            lista: cardData, 
                            cookie: cookie 
                        }] 
                    })
                });
        
                return response.results[0] || {
                    card: cardData,
                    cookie: cookie,
                    status: 'error',
                    raw_response: 'La respuesta no contiene resultados'
                };
            } catch (error) {
                return {
                    card: cardData,
                    cookie: cookie,
                    status: 'error',
                    raw_response: `Error: ${error.message}`
                };
            }
        }
        
        async function validateSingleCookie(cookie) {
            try {
                const response = await makeApiRequest(API_ENDPOINT, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `validate_cookies=1&cookies=${encodeURIComponent(JSON.stringify([cookie]))}`
                });
        
                return response.results[0] || {
                    cookie: cookie,
                    valid: false,
                    message: 'La respuesta no contiene resultados'
                };
            } catch (error) {
                return {
                    cookie: cookie,
                    valid: false,
                    message: `Error: ${error.message}`
                };
            }
        }
        
        // ========== FUNCIONES DE VISUALIZACIÓN ========== //
        
        function displayCardResult(result, showCookieStatus = false) {
            const resultsDiv = document.getElementById('cardsResults');
            const cardDisplay = result.card.length > 20 ? 
                `${result.card.substring(0, 8)}...${result.card.substring(result.card.length - 4)}` : 
                result.card;
        
            // Determinar estado de la tarjeta
            const cardStatus = getStatusBadge(result.status);
            
            // Determinar estado de la cookie si es necesario
            const cookieStatus = showCookieStatus ? 
                (result.raw_response.includes('Cookies now detected') ? 
                    '<span class="status-badge badge-cookie-ok">COOKIE OK</span>' : 
                    '<span class="status-badge badge-cookie-error">COOKIE ERROR</span>') : 
                '';
        
            resultsDiv.innerHTML += `
                <div class="card-result">
                    <div>
                        ${cardStatus}
                        ${cardDisplay}
                        ${cookieStatus}
                    </div>
                    <div class="toggle-raw" onclick="toggleRawResponse(this)">
                        ▼ Mostrar detalles
                    </div>
                    <div class="raw-response">${result.raw_response || 'No hay detalles disponibles'}</div>
                </div>
            `;
        }
        
        function displayCookieResult(result) {
            const resultsDiv = document.getElementById('cookiesResults');
            const cookieDisplay = result.cookie.length > 30 ? 
                `${result.cookie.substring(0, 20)}...` : 
                result.cookie;
            
            const status = result.valid ? 'VÁLIDA' : 'INVÁLIDA';
            const badgeClass = result.valid ? 'badge-cookie-ok' : 'badge-cookie-error';
            
            resultsDiv.innerHTML += `
                <div class="cookie-result">
                    <div>
                        <span class="status-badge ${badgeClass}">${status}</span>
                        ${cookieDisplay}
                        <small>${result.message || 'Sin mensaje adicional'}</small>
                    </div>
                    ${result.raw_response ? `
                    <div class="toggle-raw" onclick="toggleRawResponse(this)">
                        ▼ Mostrar detalles
                    </div>
                    <div class="raw-response">${result.raw_response}</div>
                    ` : ''}
                </div>
            `;
        }
        
        function getStatusBadge(status) {
            const statusMap = {
                'live': ['VIVA', 'badge-live'],
                'dead': ['MUERTA', 'badge-dead'],
                'default': ['ERROR', 'badge-error']
            };
            const [text, cls] = statusMap[status.toLowerCase()] || statusMap.default;
            return `<span class="status-badge ${cls}">${text}</span>`;
        }
        
        // ========== CONTROLADORES PRINCIPALES ========== //
        
        async function validateCards() {
            const input = document.getElementById('cardsInput').value.trim();
            if (!input) return alert('Ingrese al menos una tarjeta');
            
            const globalCookie = await showCookieModal();
            const cards = input.split('\n').filter(line => line.trim());
            const progress = initProgress('cards');
            const summary = initSummary('cards');
            
            try {
                for (let i = 0; i < cards.length; i++) {
                    updateProgress(progress, i + 1, cards.length);
                    
                    const card = cards[i].trim();
                    const result = await validateCardWithCookie(card, globalCookie);
                    displayCardResult(result, Boolean(globalCookie));
                    updateSummary(summary, result);
                    
                    await delay(REQUEST_DELAY);
                }
            } catch (error) {
                console.error('Error en validación de tarjetas:', error);
                document.getElementById('cardsResults').innerHTML += `
                    <div class="card-result">
                        <span class="status-badge badge-error">ERROR</span>
                        Error durante la validación: ${error.message}
                    </div>
                `;
                summary.error++;
                updateSummaryCounts('cards', summary);
            } finally {
                progress.container.style.display = 'none';
                document.getElementById('cardsSummary').style.display = 'flex';
            }
        }
        
        async function validateCookies() {
            const input = document.getElementById('cookiesInput').value.trim();
            if (!input) return alert('Ingrese al menos una cookie');
            
            const cookies = input.split('\n').filter(line => line.trim());
            const progress = initProgress('cookies');
            const summary = initSummary('cookies');
            
            try {
                for (let i = 0; i < cookies.length; i++) {
                    updateProgress(progress, i + 1, cookies.length);
                    
                    const cookie = cookies[i].trim();
                    const result = await validateSingleCookie(cookie);
                    displayCookieResult(result);
                    updateSummary(summary, result);
                    
                    await delay(REQUEST_DELAY);
                }
            } catch (error) {
                console.error('Error en validación de cookies:', error);
                document.getElementById('cookiesResults').innerHTML += `
                    <div class="cookie-result">
                        <span class="status-badge badge-error">ERROR</span>
                        Error durante la validación: ${error.message}
                    </div>
                `;
                summary.error++;
                updateSummaryCounts('cookies', summary);
            } finally {
                progress.container.style.display = 'none';
                document.getElementById('cookiesSummary').style.display = 'flex';
            }
        }
        
        // ========== FUNCIONES AUXILIARES ========== //
        
        function initProgress(type) {
            const container = document.getElementById(`${type}Progress`);
            const bar = document.getElementById(`${type}ProgressBar`);
            const text = document.getElementById(`${type}ProgressText`);
            
            container.style.display = 'block';
            document.getElementById(`${type}Results`).innerHTML = '';
            document.getElementById(`${type}Summary`).style.display = 'none';
            
            return { container, bar, text };
        }
        
        function updateProgress({ bar, text }, current, total) {
            const percent = Math.round((current / total) * 100);
            bar.style.width = `${percent}%`;
            text.textContent = `${percent}%`;
        }
        
        function initSummary(type) {
            return {
                total: 0,
                live: 0,
                dead: 0,
                valid: 0,
                invalid: 0,
                error: 0
            };
        }
        
        function updateSummary(summary, result) {
            summary.total++;
            
            if (result.status) {
                if (result.status === 'live') summary.live++;
                if (result.status === 'dead') summary.dead++;
                if (result.status === 'error') summary.error++;
            } else if (result.valid !== undefined) {
                if (result.valid) summary.valid++;
                else summary.invalid++;
                if (result.message && result.message.includes('Error')) summary.error++;
            }
            
            updateSummaryCounts('cards', summary);
            updateSummaryCounts('cookies', summary);
        }
        
        function updateSummaryCounts(type, summary) {
            if (type === 'cards') {
                document.getElementById('cardsTotal').textContent = summary.total;
                document.getElementById('cardsLive').textContent = summary.live;
                document.getElementById('cardsDead').textContent = summary.dead;
                document.getElementById('cardsError').textContent = summary.error;
            } else {
                document.getElementById('cookiesTotal').textContent = summary.total;
                document.getElementById('cookiesValid').textContent = summary.valid;
                document.getElementById('cookiesInvalid').textContent = summary.invalid;
                document.getElementById('cookiesError').textContent = summary.error;
            }
        }
        
        function delay(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        
        // ========== INICIALIZACIÓN ========== //
        
        document.getElementById('validateCardsBtn').addEventListener('click', validateCards);
        document.getElementById('validateCookiesBtn').addEventListener('click', validateCookies);
    </script>
</body>
</html>
