# Guia Completo de Git e GitHub para Iniciantes

## Introdução

### O que é o Git
O Git é uma ferramenta que ajuda a controlar as versões do teu código. Imagina que estás a escrever um texto num documento e queres guardar versões diferentes para não perder nada. O Git faz isso com código: guarda "fotografias" do teu projeto em momentos diferentes, para poderes voltar atrás se algo correr mal.

### O que é o GitHub
O GitHub é um site onde guardas os teus projetos Git na internet. É como uma nuvem onde partilhas o teu código com outros, ou trabalhas em equipa. Podes ver o histórico de mudanças, colaborar com colegas e até mostrar o teu trabalho a empregadores.

### Diferença entre Git e GitHub
- **Git**: É o programa que instalas no teu computador para controlar versões localmente (no teu PC).
- **GitHub**: É o serviço online onde envias o teu projeto Git para partilhar ou colaborar.

Pensa no Git como o motor do carro e no GitHub como a estrada onde conduzes.

### Porque é que isto é importante num projeto
Num projeto, especialmente se trabalhas em equipa, o Git e GitHub evitam confusões. Sabes quem mudou o quê, podes testar ideias sem estragar o trabalho principal, e recuperas versões antigas se necessário. É essencial para programadores profissionais.

## Conceitos Base

Antes de comandos, vamos entender as ideias principais:

- **Repositório (repo)**: É a "pasta" do teu projeto no Git. Tudo o que está dentro dela é controlado pelo Git.
- **Commit**: Uma "fotografia" do teu projeto num momento específico. Guarda as mudanças que fizeste.
- **Branch**: Uma linha separada de trabalho. A principal chama-se "main" (ou "master"). Crias branches para testar coisas novas sem mexer na principal.
- **Checkout / Switch**: Mudar para uma branch diferente, como trocar de canal na TV.
- **Pull**: Trazer mudanças do GitHub para o teu computador.
- **Push**: Enviar as tuas mudanças do computador para o GitHub.
- **Merge**: Juntar uma branch com outra, como fundir dois rios.
- **Clone**: Copiar um repositório do GitHub para o teu computador.
- **Add**: Preparar ficheiros para um commit, como escolher o que vai na mala de viagem.
- **Status**: Ver o estado atual do teu repositório, o que mudou e o que está pronto.
- **Log**: Ver o histórico de commits, como um diário das mudanças.

## Explicação Passo a Passo dos Comandos Principais

Vamos explicar cada comando: para que serve, quando usar, exemplo real e o que acontece depois.

### git init
- **Para que serve**: Inicia um repositório Git numa pasta vazia.
- **Quando usar**: Quando começas um novo projeto no teu computador.
- **Exemplo real**: Estás numa pasta chamada "meu-projeto" e escreves `git init`.
- **O que acontece depois**: A pasta torna-se um repositório Git. Aparece uma pasta oculta ".git". Agora podes usar outros comandos Git nessa pasta.

### git clone
- **Para que serve**: Copia um repositório do GitHub para o teu computador.
- **Quando usar**: Quando queres trabalhar num projeto que já existe no GitHub.
- **Exemplo real**: `git clone https://github.com/usuario/projeto.git`.
- **O que acontece depois**: Uma nova pasta com o projeto aparece no teu computador, pronta para trabalhar.

### git status
- **Para que serve**: Mostra o estado dos ficheiros no repositório.
- **Quando usar**: Sempre que queres ver o que mudou ou está pronto para commit.
- **Exemplo real**: `git status`.
- **O que acontece depois**: Vês uma lista de ficheiros modificados, novos ou prontos para commit. Ajuda-te a decidir o próximo passo.

### git add .
- **Para que serve**: Prepara todos os ficheiros modificados para o próximo commit.
- **Quando usar**: Depois de fazeres mudanças e antes de commitar.
- **Exemplo real**: `git add .` (o ponto significa "todos os ficheiros").
- **O que acontece depois**: Os ficheiros ficam "staged" (prontos). No próximo `git status`, aparecem em verde.

### git commit -m "mensagem"
- **Para que serve**: Guarda as mudanças preparadas num commit.
- **Quando usar**: Depois de `git add`, para criar uma versão nova.
- **Exemplo real**: `git commit -m "Adicionei botão de login"`.
- **O que acontece depois**: As mudanças ficam guardadas localmente. Podes ver no `git log`.

### git pull
- **Para que serve**: Traz mudanças do GitHub para o teu computador.
- **Quando usar**: Antes de começar a trabalhar, para teres a versão mais recente.
- **Exemplo real**: `git pull origin main`.
- **O que acontece depois**: O teu repositório local fica atualizado com as mudanças do GitHub.

### git push
- **Para que serve**: Envia os teus commits locais para o GitHub.
- **Quando usar**: Depois de commitar, para partilhar o trabalho.
- **Exemplo real**: `git push origin main`.
- **O que acontece depois**: As tuas mudanças aparecem no GitHub. Outros podem vê-las.

### git branch
- **Para que serve**: Mostra as branches existentes ou cria uma nova.
- **Quando usar**: Para ver branches ou criar uma.
- **Exemplo real**: `git branch` (mostra) ou `git branch nova-funcionalidade` (cria).
- **O que acontece depois**: Vês a lista de branches ou uma nova é criada.

### git switch
- **Para que serve**: Muda para uma branch diferente.
- **Quando usar**: Quando queres trabalhar noutra branch.
- **Exemplo real**: `git switch main`.
- **O que acontece depois**: Estás agora nessa branch. Os ficheiros mudam para o estado dessa branch.

### git checkout
- **Para que serve**: Similar ao switch, mas também pode criar branches.
- **Quando usar**: Para mudar ou criar branches (mais antigo, usa switch agora).
- **Exemplo real**: `git checkout -b nova-branch` (cria e muda).
- **O que acontece depois**: Mudas para a branch ou crias uma nova.

### git merge
- **Para que serve**: Junta uma branch com outra.
- **Quando usar**: Quando queres incorporar mudanças de uma branch para a main.
- **Exemplo real**: Estás na main e fazes `git merge funcionalidade`.
- **O que acontece depois**: As mudanças da outra branch vêm para a atual. Pode haver conflitos se houver mudanças iguais.

## Fluxo Real de Trabalho

Vamos simular um dia de trabalho:

1. **Abrir projeto**: Abre a pasta do projeto no terminal (ex: `cd meu-projeto`).
2. **Ver em que branch estás**: `git status` ou `git branch` (procura o * na lista).
3. **Mudar para a main**: `git switch main`.
4. **Fazer pull**: `git pull origin main` (traz atualizações).
5. **Criar nova branch**: `git switch -c nova-ideia` (cria e muda).
6. **Trabalhar nela**: Edita ficheiros, testa.
7. **Fazer add**: `git add .` (prepara mudanças).
8. **Commit**: `git commit -m "Implementei nova ideia"`.
9. **Push**: `git push origin nova-ideia` (envia a branch nova).
10. **Voltar à main**: `git switch main`.
11. **Continuar desenvolvimento**: Repete para outras tarefas.

## Exemplos Reais com Frases Simples

- **"Quero corrigir a página inicial"**: Cria branch `git switch -c corrigir-home`, edita, `git add .`, `git commit -m "Corrigi erro na home"`, `git push origin corrigir-home`.
- **"Quero criar uma branch para testar uma funcionalidade"**: `git switch -c teste-funcionalidade`.
- **"Quero enviar o meu trabalho para o GitHub"**: `git push origin main`.
- **"Quero ir buscar as alterações do GitHub"**: `git pull origin main`.

## Erros Comuns de Iniciantes

- **Esquecer git add .**: Fazes mudanças mas não preparas. Solução: `git add .` antes de commit.
- **Commit sem mensagem clara**: "fix" não diz nada. Usa frases como "Adicionei validação de email".
- **Push sem commit**: Nada para enviar. Faz commit primeiro.
- **Estar na branch errada**: Trabalhas na main por engano. Verifica com `git branch`.
- **Conflitos simples**: Duas pessoas mudaram o mesmo. Resolve editando o ficheiro e commitando.
- **Mexer na main sem cuidado**: Sempre usa branches para testes.

## Boas Práticas

- **Quando usar main**: Só para código estável e testado.
- **Quando criar branch**: Para cada nova funcionalidade ou correção.
- **Como escrever commits**: Curtos mas descritivos, em português ou inglês.
- **Quando fazer pull**: Sempre antes de começar a trabalhar.
- **Organização**: Uma branch por tarefa, nomes claros (ex: "adicionar-login").

## Resumo Final

O Git controla versões do código, o GitHub partilha online. Começa com `git init`, trabalha com add/commit, usa branches para segurança, push/pull para colaboração.

**Quadro mental**:
- Commit = guardar
- Push = enviar
- Pull = buscar
- Branch = linha separada de trabalho

## Guia Rápido de Bolso

- `git init`: Inicia repo
- `git clone <url>`: Copia repo
- `git status`: Vê estado
- `git add .`: Prepara tudo
- `git commit -m "msg"`: Guarda
- `git pull origin main`: Busca
- `git push origin main`: Envia
- `git branch`: Lista branches
- `git switch <branch>`: Muda branch
- `git merge <branch>`: Junta

## Exemplo de Aula Prática

No terminal:

```
cd meu-projeto
git status
git switch main
git pull origin main
git switch -c contar-pontos
# Trabalha nos ficheiros...
git add .
git commit -m "Adicionei contagem de pontos"
git push origin contar-pontos
git switch main
# Pronto, voltaste à main para continuar
```

Este guia é para copiar e estudar. Pratica no teu projeto!