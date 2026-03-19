# IA Teste (Mini site)

Este é um projeto de aprendizagem que corre localmente no XAMPP. Está organizado como um mini sistema de perguntas e respostas com **login**, **registo**, **dashboard** e áreas separadas para **alunos** e **tutores**.

## Estrutura do projeto

A pasta principal deve ficar em:

```
C:\xampp\htdocs\ia-teste
```

O projeto inclui:

- `index.php` — página inicial profissional
- `login.php` — formulário de início de sessão (simulado)
- `registo.php` — formulário de registo (simulado)
- `dashboard.php` — área do utilizador/aluno após login
- `teste.php` — quiz de Git com perguntas em dropdown
- `resultado.php` — mostra o resultado do quiz com revisão e feedback
- `tutor.php` — interface visual para o tutor rever respostas
- `style.css` — estilos globais
- `script.js` — lógica visual simples (marca respostas como certo/errado)
- `includes/` — cabeçalho e rodapé reutilizáveis

## Como correr no XAMPP

1. Certifica-te de que o XAMPP está instalado e que o **Apache** está a correr.
2. Copia a pasta `ia-teste` para `C:\xampp\htdocs\`.
3. Abre o navegador e vai para:

```
http://localhost/ia-teste/
```

4. A partir da homepage podes:
   - Iniciar sessão (simulado)
   - Criar conta (simulado)
   - Fazer o teste
   - Ver resultado do teste
   - Aceder à área de tutor (se o utilizador for tutor)

## Sobre a implementação

- Não existe ligação a nenhuma base de dados.
- Os dados são guardados apenas na sessão do navegador (para efeitos de demonstração).
- O tutor pode marcar as respostas como "Certo" ou "Errado" de forma puramente visual.

## Sugestões para evoluir o projeto

Se quiseres, mais tarde podes criar branches como:

- `homepage`
- `login`
- `dashboard`
- `tutor`
- `design-novo`

Basta criar e alternar entre as branches no teu repositório local (sem necessidade de GitHub).