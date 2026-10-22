// Importações usando a versão estável do Firebase
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getDatabase, ref, push, onValue, remove, update, get } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

const firebaseConfig = { //Configurações do Firebase.
    apiKey: "AIzaSyAoTkKdI-9upwPvNRyEkdWgKG0qNhkMOpQ",
    authDomain: "aquario-f1d9c.firebaseapp.com",
    databaseURL: "https://aquario-f1d9c-default-rtdb.firebaseio.com",
    projectId: "aquario-f1d9c",
    storageBucket: "aquario-f1d9c.firebasestorage.app",
    messagingSenderId: "1085669322281",
    appId: "1:1085669322281:web:37e2f03d02e2c0c535f638",
};

// Inicializa o Firebase
const app = initializeApp(firebaseConfig);
const db = getDatabase(app);
const leituraRef = ref(db, "leituras");

const cardPh = document.getElementById("card-ph");
const cardTemp = document.getElementById("card-temp");
const cardTurb = document.getElementById("card-turb");

const tabelaLeitura = document.getElementById("tabela-leituras");

const formEditar = document.getElementById("form-editar")

if(tabelaLeitura){ 

    onValue(leituraRef, (snapshot) => { //Sempre observando e tirando fotos.
        if (snapshot.exists()) { //Se existir uma foto.
            const dados = snapshot.val(); //Constante recebe os dados da foto.
            let ultimaLeitura = null;

            Object.keys(dados).forEach((id) => { // Percorre o banco e cria um Objeto com todos os ID's do firebase.
                const item = dados[id];
                ultimaLeitura = item;

                const tr = document.createElement("tr");
                tr.innerHTML = "<td>" + item.data + " às" + item.hora + "</td>" +
                    "<td>" + item.ph + "ph -" + item.temperatura + "ºC - " + item.turbidez + "NTU </td>" +
                    "<td> <button class= 'bt-acao btn-alterar' data-id ='" + id + "'> Alterar </button>" +
                    "<button class= 'bt-acao btn-excluir' data-id ='" + id + "'> Excluir </button> </td>";

                tabelaLeitura.prepend(tr);

            });

            if (ultimaLeitura) {
                cardPh.innerHTML = ultimaLeitura.ph;
                cardTemp.innerHTML = ultimaLeitura.temperatura + " ºC";
                cardTurb.innerHTML = ultimaLeitura.turbidez + " NTU";

            }
        }
    });

    tabelaLeitura.addEventListener("click", (evento)=>{
        const id = evento.target.getAttribute("data-id");

        if(evento.target.classList.contains("btn-excluir")){
            if(confirm("Tem certeza que quer excluir?")){
                const itemRef = ref(db, "leituras/"+id);
                remove(itemRef);
            }
        }

        if(evento.target.classList.contains("btn-alterar")){
            window.location.href = "editar.php?id="+id;
        }
    });
}


if(formEditar){
    const parametros = URLSearchParams(window.location.search);
    const id = parametros.get("id");

    const itemRef = ref(db, "leituras/"+id);
    get(itemRef,((snapshot)=>{
    if(snapshot.exists()){
    const dados = snapshot.val();
    document.getElementById("ph").value = dados.ph;
    document.getElementById("temperatura").value = dados.temperatura;
    document.getElementById("turbidez").value = dados.turbidez;
    }
    }));
}


let t = 60;

function gravarLeitura() {
    const agora = new Date();
    document.getElementById('painel').innerHTML = "Nova leitura em " + t-- + "s";

    if (t <= 0) {
        const novaLeitura = { //Objeto da leitura
            ph: Number((Math.random() * (8.5 - 6.5) + 6.5).toFixed(1)), //Número aleatorios para fins educacionais, 
            temperatura: Number((Math.random() * (28 - 22) + 22).toFixed(1)), //seriam como se fosse os dados vindo de sensores.
            turbidez: Number((Math.random() * (28 - 22) + 22).toFixed(1)),
            data: agora.toLocaleDateString("pt-BR"),
            hora: agora.toLocaleTimeString("pt-BR")
        };
        console.log("Fiz uma leitura legal")

        push(leituraRef, novaLeitura);
        t = 60;
        console.log("Fiz uma leitura legal 2")

    }
}


setInterval(gravarLeitura, 1000)