<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{$title}} | Toko Surya Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
            ::-webkit-scrollbar {
    width: 5px;
    border-radius: 1rem;

    }

    /* Track */
    ::-webkit-scrollbar-track {
    background: #1E2541;
    border-radius: 1rem;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: #8FD2A7;
    border-radius: 1rem;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #FFA46B ;
    }

    primary {
        color: #8FD2A7;
    }

    secondary {
        color: #E3F3E8;
    }

    content {
        color: #F4F6F8;
    }

    caption {
        color: #353535;
    }

    fill {
        color: #FFFFFF;
    }
    </style>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="font-body bg-content flex w-full">

    

    <sidebar class="flex overflow-y-clip min-h-screen w-60 bg-fill flex-col justify-between p-10"> @yield('sidebar') </sidebar>
    <content class="w-full h-screen overflow-auto px-16"> @yield('content') </content>

    <script>
        let fileinput     = document.getElementById('profil');
        let fileinputEdit = document.getElementById('profilEdits');
        let spanfile      = document.getElementById('fileName');
        let spanfileEdit  = document.getElementById('fileNameEdit');
        let aa;
        fileinput.onchange = function () {
            aa = this.value.split("\\");
            spanfile.innerHTML = aa[aa.length-1];
        };
        fileinputEdit.onchange = function () {
            aa = this.value.split("\\");
            spanfileEdit.innerHTML = aa[aa.length-1];
        };
    
        let idUserObj      = document.getElementById('idUserEdit');
        let usernameObj    = document.getElementById('usernameEdit');
        let profilObj      = document.getElementById('profilEdit');
        let namaLengkapObj = document.getElementById('namalengkapEdit');
        let hpObj          = document.getElementById('hpEdit');
        let alamatObj      = document.getElementById('alamatEdit');
        let gambarSkgObj   = document.getElementById('gambarEditSkg');

    
        function editModal(obj)
        {
            //obj
            const idUser   = obj.getAttribute("data-idUser");
            const username = obj.getAttribute("data-username");
            const namaUser = obj.getAttribute("data-namaUser");
            const alamat   = obj.getAttribute("data-alamat");
            const no       = obj.getAttribute("data-noHp");
            const gambar   = obj.getAttribute("data-gambar");
            const gambarS  = obj.getAttribute("data-gambarSkg");

            // console.log(gambarS);
            idUserObj.value      = idUser;
            usernameObj.value    = username;
            namaLengkapObj.value = namaUser;
            alamatObj.value      = alamat;
            hpObj.value          = no;
            gambarSkgObj.value   = gambarS;

            profilObj.style.background      = `url('${gambar}') top center`;
            profilObj.style.backgroundSize  = 'cover';
            
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>
</html>