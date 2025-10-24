<?php
session_start();
require_once 'auth.php'; // já faz a checagem

// 🔴 remova essas linhas
// $auth = new Auth();
// $auth->checkAccess();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema - Funcionários</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", Roboto, Arial, sans-serif;
}

body {
    background: linear-gradient(135deg, #1f2a44 0%, #2b61c3 100%);
    color: #222;
    min-height: 100vh;
}

/* ---------- CABEÇALHO ---------- */
.header {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    color: white;
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
}

.header h1 {
    font-size: 1.8rem;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.logout-btn {
    background: transparent;
    color: white;
    border: 1px solid rgba(255,255,255,0.7);
    padding: 8px 18px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
    transition: all 0.3s ease;
}

.logout-btn:hover {
    background: rgba(255,255,255,0.2);
}

/* ---------- CONTAINER PRINCIPAL ---------- */
.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
}

/* ---------- CARTÕES ---------- */
.card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.card h2 {
    color: #1f2a44;
    margin-bottom: 25px;
    border-left: 5px solid #2b61c3;
    padding-left: 10px;
}

/* ---------- FORMULÁRIO ---------- */
.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 6px;
    display: block;
}

input, select {
    width: 100%;
    padding: 10px 12px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    transition: all 0.25s ease;
    background: #fafafa;
}

input:focus, select:focus {
    outline: none;
    border-color: #2b61c3;
    box-shadow: 0 0 5px rgba(43,97,195,0.3);
    background: white;
}

/* ---------- BOTÕES ---------- */
.actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: #2b61c3;
    color: white;
}

.btn-primary:hover {
    background: #1f49a0;
    transform: scale(1.03);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}

.btn-danger {
    background: #e74c3c;
    color: white;
}

.btn-danger:hover {
    background: #c0392b;
}

/* ---------- TABELA ---------- */
.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 15px;
}

th, td {
    padding: 12px 14px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

th {
    background: #f3f6fb;
    color: #333;
    font-weight: 600;
}

tr:hover {
    background: #f9fbff;
}

.actions button {
    font-size: 14px;
    padding: 6px 12px;
}

/* ---------- RESPONSIVIDADE ---------- */
@media (max-width: 768px) {
    .header {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }

    .header h1 {
        font-size: 1.5rem;
    }

    .btn {
        font-size: 14px;
        padding: 8px 16px;
    }
}
</style>
</head>
<body>
    <div class="header">
        <h1>Sistema de Funcionários</h1>
        <button class="logout-btn" onclick="logout()">Sair</button>
    </div>

    <div class="container">
        <!-- Formulário de Cadastro/Edição -->
        <div class="card">
            <h2 id="formTitle">Cadastrar Funcionário</h2>
            <form id="funcionarioForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="tel" id="telefone" name="telefone" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="cargo">Cargo:</label>
                        <input type="text" id="cargo" name="cargo" required>
                    </div>
                    <div class="form-group">
                        <label for="departamento">Departamento:</label>
                        <select id="departamento" name="departamento" required>
                            <option value="">Selecione...</option>
                            <option value="TI">TI</option>
                            <option value="RH">RH</option>
                            <option value="Vendas">Vendas</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Financeiro">Financeiro</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="salario">Salário:</label>
                        <input type="number" id="salario" name="salario" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="dataAdmissao">Data de Admissão:</label>
                        <input type="date" id="dataAdmissao" name="dataAdmissao" required>
                    </div>
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary" id="submitBtn">Cadastrar</button>
                    <button type="button" class="btn btn-secondary" id="cancelBtn" onclick="cancelEdit()" style="display: none;">Cancelar</button>
                </div>
            </form>
        </div>

        <!-- Lista de Funcionários -->
        <div class="card">
            <h2>Funcionários Cadastrados</h2>
            <div class="table-container">
                <table id="tabelaFuncionarios">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Cargo</th>
                            <th>Departamento</th>
                            <th>Salário</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaBody">
                        <!-- Os dados serão inseridos aqui via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Verificar se o usuário está logado (via session PHP)
        // Se não estiver logado, redireciona para index.php
        fetch('check_auth.php')
            .then(response => response.json())
            .then(data => {
                if (!data.logged_in) {
                    window.location.href = 'index.php';
                }
            });

        let funcionarios = JSON.parse(localStorage.getItem('funcionarios')) || [];
        let editandoIndex = null;

        // Elementos do DOM
        const form = document.getElementById('funcionarioForm');
        const tabelaBody = document.getElementById('tabelaBody');
        const formTitle = document.getElementById('formTitle');
        const submitBtn = document.getElementById('submitBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        // Inicializar a tabela
        atualizarTabela();

        // Evento de submit do formulário
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const funcionario = {
                nome: document.getElementById('nome').value,
                cpf: document.getElementById('cpf').value,
                email: document.getElementById('email').value,
                telefone: document.getElementById('telefone').value,
                cargo: document.getElementById('cargo').value,
                departamento: document.getElementById('departamento').value,
                salario: document.getElementById('salario').value,
                dataAdmissao: document.getElementById('dataAdmissao').value
            };

            if (editandoIndex !== null) {
                // Editar funcionário existente
                funcionarios[editandoIndex] = funcionario;
                editandoIndex = null;
            } else {
                // Adicionar novo funcionário
                funcionarios.push(funcionario);
            }

            // Salvar no localStorage
            localStorage.setItem('funcionarios', JSON.stringify(funcionarios));
            
            // Atualizar a tabela e resetar o formulário
            atualizarTabela();
            form.reset();
            cancelEdit();
        });

        function editarFuncionario(index) {
            const funcionario = funcionarios[index];
            
            // Preencher o formulário com os dados do funcionário
            document.getElementById('nome').value = funcionario.nome;
            document.getElementById('cpf').value = funcionario.cpf;
            document.getElementById('email').value = funcionario.email;
            document.getElementById('telefone').value = funcionario.telefone;
            document.getElementById('cargo').value = funcionario.cargo;
            document.getElementById('departamento').value = funcionario.departamento;
            document.getElementById('salario').value = funcionario.salario;
            document.getElementById('dataAdmissao').value = funcionario.dataAdmissao;
            
            // Alterar o formulário para modo edição
            editandoIndex = index;
            formTitle.textContent = 'Editar Funcionário';
            submitBtn.textContent = 'Atualizar';
            cancelBtn.style.display = 'inline-block';
        }

        function excluirFuncionario(index) {
            if (confirm('Tem certeza que deseja excluir este funcionário?')) {
                funcionarios.splice(index, 1);
                localStorage.setItem('funcionarios', JSON.stringify(funcionarios));
                atualizarTabela();
            }
        }

        function cancelEdit() {
            editandoIndex = null;
            form.reset();
            formTitle.textContent = 'Cadastrar Funcionário';
            submitBtn.textContent = 'Cadastrar';
            cancelBtn.style.display = 'none';
        }

        function atualizarTabela() {
            tabelaBody.innerHTML = '';
            
            funcionarios.forEach((funcionario, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${funcionario.nome}</td>
                    <td>${funcionario.cpf}</td>
                    <td>${funcionario.email}</td>
                    <td>${funcionario.cargo}</td>
                    <td>${funcionario.departamento}</td>
                    <td>R$ ${parseFloat(funcionario.salario).toFixed(2)}</td>
                    <td class="actions">
                        <button class="btn btn-primary" onclick="editarFuncionario(${index})">Editar</button>
                        <button class="btn btn-danger" onclick="excluirFuncionario(${index})">Excluir</button>
                    </td>
                `;
                tabelaBody.appendChild(row);
            });
        }

        function logout() {
            // Fazer logout via PHP
            fetch('logout.php')
                .then(() => {
                    window.location.href = 'index.php';
                });
        }

        // Formatar CPF
        document.getElementById('cpf').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2')
                           .replace(/(\d{3})(\d)/, '$1.$2')
                           .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            }
        });

        // Formatar telefone
        document.getElementById('telefone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                if (value.length <= 10) {
                    value = value.replace(/(\d{2})(\d)/, '($1) $2')
                               .replace(/(\d{4})(\d)/, '$1-$2');
                } else {
                    value = value.replace(/(\d{2})(\d)/, '($1) $2')
                               .replace(/(\d{5})(\d)/, '$1-$2');
                }
                e.target.value = value;
            }
        });
    </script>
</body>
</html>