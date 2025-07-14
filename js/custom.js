new DataTable("#table-list-users", {
  ajax: "./db/listar_usuarios.php",
  processing: false,
  serverSide: true,
  //lengthChange: false, //número de itens por página
  language: {
    url: "https://cdn.datatables.net/plug-ins/2.3.2/i18n/pt-BR.json",
  },
});

const formUser = document.getElementById("form-cad-usuario");
const fecharModalCard = new bootstrap.Modal(document.getElementById("cadUsuarioModal"));
if (formUser) {
  formUser.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dadosForm = new FormData(formUser);

    const dados = await fetch("./db/cadastrar.php", {
      method: "POST",
      body: dadosForm,
    });

    const resposta = await dados.json();
    if (resposta["success"]) {
      document.getElementById("msgAlertErrorCad").innerHTML = "";
      document.getElementById("msgAlert").innerHTML =
        resposta["message"];
        formUser.reset();
        fecharModalCard.hide();

        listarDatatables = $("#table-list-users").DataTable();
        listarDatatables.draw();
    } else {
      document.getElementById("msgAlertErrorCad").innerHTML =
        resposta["message"];
    }
  });
}

async function visUsuario(id){
    const dados = await fetch("./db/visualizar.php?id="+id);
    const resposta = await dados.json();

    if(resposta['success']){
        const visModal = new bootstrap.Modal(document.getElementById("visUsuarioModal"));
        document.getElementById("idUsuario").innerText = resposta['dados'].id;
        document.getElementById("nomeUsuario").innerText = resposta['dados'].nome;
        document.getElementById("salarioUsuario").innerText = resposta['dados'].salario;
        document.getElementById("idadeUsuario").innerText = resposta['dados'].idade;
        visModal.show();
        document.getElementById("msgAlert").innerHTML = "";
    }else{
        document.getElementById("msgAlert").innerHTML = resposta['message'];
    }
}
