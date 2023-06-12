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
        .btn {
            background-color: #fff; 
        }
        .addorder {
            border: 2px solid #8FD2A7;
            background-color: #E3F3E8 ;
        }
        ::-webkit-scrollbar {
            width: 5px;
            border-radius:1rem;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #fff;
            border-radius:1rem;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #8FD2A7;
            border-radius: 1rem;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: yellowgreen ;
        }
    </style>
</head>
<body class="font-body bg-fill">
    <div class="flex">
        <div class="bg-fill">
            <sidebar class="flex h-screen w-60 bg-fill rounded-r-3xl flex-col justify-between p-10"> @yield('sidebar') </sidebar>
        </div>
        @yield('content')
    </div>


    <script>
                let valM    = document.getElementById('valMenu');
        let valJ    = document.getElementById('valJml');
        let lm      = document.getElementById('listmenu');  
        var ttlObj  = document.getElementById('totalhg');  

        let lstm    =[];
        let lstidm  =[];
        let lstNm   =[];
        let lstVal  =[];
        let lsthg   =[];
        let lstGb   =[];

        let buttons = document.querySelectorAll('.btn');
        var total   = 0;
        
        function tmbh(d)
        {
            valM.value = lstidm;
            valJ.value = lstVal;
            console.log(valJ.value);
        }

        buttons.forEach(button => {
            button.addEventListener('click', function (){
                this.classList.add('addorder');
            });
        })


        function hasClass( target, className ) {
            return new RegExp('(\\s|^)' + className + '(\\s|$)').test(target.className);
        }

        function cobu(d){
            const ss    =  d.getAttribute("data-idmenu");
            const nama  =d.getAttribute("data-namamenu");
            const harga =d.getAttribute("data-hargamenu");
            const gambar=d.getAttribute("data-gambar");
            const hg    =d.getAttribute("data-hg");
            let da      = document.getElementById(d.getAttribute("data-idm")+"-inp");

            if (!hasClass(d,"terklik")) {
                lstidm.push(ss);
                lstVal.push(1);
                lstNm.push(nama);
                lsthg.push(hg);

                lstGb.push(gambar);
                console.log(lsthg);
                lstm.push(`<div class="flex gap-4 w-full p-4 h-28 bg-primary rounded-lg ${ss}">
                    <div class="h-full w-full flex justify-between items-center">
                        <div class="w-full h-full flex items-center justify-start gap-3">
                            <div>
                                <button data-idm=${ss} data-hg=${hg} onclick='hps(this);'>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="35px" height="35px" fill-rule="nonzero"><g fill="#ff4747" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M24,4c-3.50831,0 -6.4296,2.62143 -6.91992,6h-6.8418c-0.08516,-0.01457 -0.17142,-0.02176 -0.25781,-0.02148c-0.07465,0.00161 -0.14908,0.00879 -0.22266,0.02148h-3.25781c-0.54095,-0.00765 -1.04412,0.27656 -1.31683,0.74381c-0.27271,0.46725 -0.27271,1.04514 0,1.51238c0.27271,0.46725 0.77588,0.75146 1.31683,0.74381h2.13867l2.51758,26.0293c0.27108,2.80663 2.65553,4.9707 5.47461,4.9707h14.73633c2.81922,0 5.20364,-2.16383 5.47461,-4.9707l2.51953,-26.0293h2.13867c0.54095,0.00765 1.04412,-0.27656 1.31683,-0.74381c0.27271,-0.46725 0.27271,-1.04514 0,-1.51238c-0.27271,-0.46725 -0.77588,-0.75146 -1.31683,-0.74381h-3.25586c-0.15912,-0.02581 -0.32135,-0.02581 -0.48047,0h-6.84375c-0.49032,-3.37857 -3.41161,-6 -6.91992,-6zM24,7c1.87916,0 3.42077,1.26816 3.86133,3h-7.72266c0.44056,-1.73184 1.98217,-3 3.86133,-3zM11.65039,13h24.69727l-2.49219,25.74023c-0.12503,1.29513 -1.18751,2.25977 -2.48828,2.25977h-14.73633c-1.29892,0 -2.36336,-0.96639 -2.48828,-2.25977zM20.47656,17.97852c-0.82766,0.01293 -1.48843,0.69381 -1.47656,1.52148v15c-0.00765,0.54095 0.27656,1.04412 0.74381,1.31683c0.46725,0.27271 1.04514,0.27271 1.51238,0c0.46725,-0.27271 0.75146,-0.77588 0.74381,-1.31683v-15c0.00582,-0.40562 -0.15288,-0.7963 -0.43991,-1.08296c-0.28703,-0.28666 -0.67792,-0.44486 -1.08353,-0.43852zM27.47656,17.97852c-0.82766,0.01293 -1.48843,0.69381 -1.47656,1.52148v15c-0.00765,0.54095 0.27656,1.04412 0.74381,1.31683c0.46725,0.27271 1.04514,0.27271 1.51238,0c0.46725,-0.27271 0.75146,-0.77588 0.74381,-1.31683v-15c0.00582,-0.40562 -0.15288,-0.7963 -0.43991,-1.08296c-0.28703,-0.28666 -0.67792,-0.44486 -1.08353,-0.43852z"></path></g></g></svg>
                                </button>
                            </div>
                            <div>
                                <h1 class="font-semibold text-base text-fill text-left"> ${nama}</h1>
                                <p class="font-medium text-base text-fill">Rp. ${hg}</p>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <button data-idm=${ss} data-hg=${hg} onclick='krval(this);' class="submit bg-fill text-primary rounded-lg px-3.5 py-1 font-bold text-xl">-</button>
                                <input id=${ss}-inp disabled type="number" min="1" class="text-xl font-semibold w-12 py-1.5 text-center bg-primary   " value=1>
                                <button data-idm=${ss} data-hg=${hg} onclick='tmbhval(this);' class="submit bg-fill text-primary rounded-md px-3 py-1 font-bold text-xl">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                        `);


                let cobustr = '';
                for(let i=0;i<lstm.length;i++)
                {
                    cobustr = `<div class="flex gap-4 w-full p-4 h-28 bg-primary rounded-lg ${lstidm[i]}">
                    <div class="h-full w-full flex justify-between items-center">
                        <div class="w-full h-full flex items-center justify-start gap-3">
                            <div>
                                <button data-idm=${lstidm[i]} data-hg=${lsthg[i]} onclick='hps(this);'>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="35px" height="35px" fill-rule="nonzero"><g fill="#ff4747" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M24,4c-3.50831,0 -6.4296,2.62143 -6.91992,6h-6.8418c-0.08516,-0.01457 -0.17142,-0.02176 -0.25781,-0.02148c-0.07465,0.00161 -0.14908,0.00879 -0.22266,0.02148h-3.25781c-0.54095,-0.00765 -1.04412,0.27656 -1.31683,0.74381c-0.27271,0.46725 -0.27271,1.04514 0,1.51238c0.27271,0.46725 0.77588,0.75146 1.31683,0.74381h2.13867l2.51758,26.0293c0.27108,2.80663 2.65553,4.9707 5.47461,4.9707h14.73633c2.81922,0 5.20364,-2.16383 5.47461,-4.9707l2.51953,-26.0293h2.13867c0.54095,0.00765 1.04412,-0.27656 1.31683,-0.74381c0.27271,-0.46725 0.27271,-1.04514 0,-1.51238c-0.27271,-0.46725 -0.77588,-0.75146 -1.31683,-0.74381h-3.25586c-0.15912,-0.02581 -0.32135,-0.02581 -0.48047,0h-6.84375c-0.49032,-3.37857 -3.41161,-6 -6.91992,-6zM24,7c1.87916,0 3.42077,1.26816 3.86133,3h-7.72266c0.44056,-1.73184 1.98217,-3 3.86133,-3zM11.65039,13h24.69727l-2.49219,25.74023c-0.12503,1.29513 -1.18751,2.25977 -2.48828,2.25977h-14.73633c-1.29892,0 -2.36336,-0.96639 -2.48828,-2.25977zM20.47656,17.97852c-0.82766,0.01293 -1.48843,0.69381 -1.47656,1.52148v15c-0.00765,0.54095 0.27656,1.04412 0.74381,1.31683c0.46725,0.27271 1.04514,0.27271 1.51238,0c0.46725,-0.27271 0.75146,-0.77588 0.74381,-1.31683v-15c0.00582,-0.40562 -0.15288,-0.7963 -0.43991,-1.08296c-0.28703,-0.28666 -0.67792,-0.44486 -1.08353,-0.43852zM27.47656,17.97852c-0.82766,0.01293 -1.48843,0.69381 -1.47656,1.52148v15c-0.00765,0.54095 0.27656,1.04412 0.74381,1.31683c0.46725,0.27271 1.04514,0.27271 1.51238,0c0.46725,-0.27271 0.75146,-0.77588 0.74381,-1.31683v-15c0.00582,-0.40562 -0.15288,-0.7963 -0.43991,-1.08296c-0.28703,-0.28666 -0.67792,-0.44486 -1.08353,-0.43852z"></path></g></g></svg>
                                </button>
                            </div>
                            <div>
                                <h1 class="font-semibold text-base text-fill text-left"> ${lstNm[i]}</h1>
                                <p class="font-medium text-base text-fill">Rp. ${lsthg[i]}</p>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <button data-idm=${lstidm[i]} data-hg=${lsthg[i]} onclick='krval(this);' class="submit bg-fill text-primary rounded-lg px-3.5 py-1 font-bold text-xl">-</button>
                                <input id=${lstidm[i]}-inp disabled type="number" min="1" class="text-xl font-semibold w-12 py-1.5 text-center bg-primary   " value=${lstVal[i]}>
                                <button data-idm=${lstidm[i]} data-hg=${lsthg[i]} onclick='tmbhval(this);' class="submit bg-fill text-primary rounded-md px-3 py-1 font-bold text-xl">+</button>
                            </div>
                        </div>
                    </div>
                </div>`+cobustr ;
                }
                // console.log(lstidm);
                // console.log(lstVal);
                lm.innerHTML = cobustr;
                d.classList.add('terklik');
                total+= Number(hg);
                ttlObj.innerHTML = formatRupiah(String(total), 'Rp. ');
            }
            
            // alert(d.getAttribute("data-idmenu")+cobustr);
        }



        function hps(d)
        {
            let buttons = document.querySelectorAll('.addorder');
            const hg    = d.getAttribute("data-hg");

            let ssd = document.getElementById(d.getAttribute("data-idm"));
            let da  = document.getElementById(d.getAttribute("data-idm")+"-inp");
            ssd.classList.remove('addorder');
            ssd.classList.remove('terklik');

            let a1 = lstidm.indexOf(d.getAttribute("data-idm"));
            total-=Number(lsthg[a1]*da.value);
            lstm.splice(a1,1);
            lstidm.splice(a1,1);
            lstVal.splice(a1,1);
            lstNm.splice(a1,1);
            lsthg.splice(a1,1);
            lstGb.splice(a1,1);

            let cobustr = '';
            for(let i=0;i<lstm.length;i++)
            {
                cobustr = `
                        <div class="flex gap-4 w-full p-4 h-28 bg-primary rounded-lg ${lstidm[i]}">
                    <div class="h-full w-full flex justify-between items-center">
                        <div class="w-full h-full flex items-center justify-start gap-3">
                            <div>
                                <button data-idm=${lstidm[i]} data-hg=${lsthg[i]} onclick='hps(this);'>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="35px" height="35px" fill-rule="nonzero"><g fill="#ff4747" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M24,4c-3.50831,0 -6.4296,2.62143 -6.91992,6h-6.8418c-0.08516,-0.01457 -0.17142,-0.02176 -0.25781,-0.02148c-0.07465,0.00161 -0.14908,0.00879 -0.22266,0.02148h-3.25781c-0.54095,-0.00765 -1.04412,0.27656 -1.31683,0.74381c-0.27271,0.46725 -0.27271,1.04514 0,1.51238c0.27271,0.46725 0.77588,0.75146 1.31683,0.74381h2.13867l2.51758,26.0293c0.27108,2.80663 2.65553,4.9707 5.47461,4.9707h14.73633c2.81922,0 5.20364,-2.16383 5.47461,-4.9707l2.51953,-26.0293h2.13867c0.54095,0.00765 1.04412,-0.27656 1.31683,-0.74381c0.27271,-0.46725 0.27271,-1.04514 0,-1.51238c-0.27271,-0.46725 -0.77588,-0.75146 -1.31683,-0.74381h-3.25586c-0.15912,-0.02581 -0.32135,-0.02581 -0.48047,0h-6.84375c-0.49032,-3.37857 -3.41161,-6 -6.91992,-6zM24,7c1.87916,0 3.42077,1.26816 3.86133,3h-7.72266c0.44056,-1.73184 1.98217,-3 3.86133,-3zM11.65039,13h24.69727l-2.49219,25.74023c-0.12503,1.29513 -1.18751,2.25977 -2.48828,2.25977h-14.73633c-1.29892,0 -2.36336,-0.96639 -2.48828,-2.25977zM20.47656,17.97852c-0.82766,0.01293 -1.48843,0.69381 -1.47656,1.52148v15c-0.00765,0.54095 0.27656,1.04412 0.74381,1.31683c0.46725,0.27271 1.04514,0.27271 1.51238,0c0.46725,-0.27271 0.75146,-0.77588 0.74381,-1.31683v-15c0.00582,-0.40562 -0.15288,-0.7963 -0.43991,-1.08296c-0.28703,-0.28666 -0.67792,-0.44486 -1.08353,-0.43852zM27.47656,17.97852c-0.82766,0.01293 -1.48843,0.69381 -1.47656,1.52148v15c-0.00765,0.54095 0.27656,1.04412 0.74381,1.31683c0.46725,0.27271 1.04514,0.27271 1.51238,0c0.46725,-0.27271 0.75146,-0.77588 0.74381,-1.31683v-15c0.00582,-0.40562 -0.15288,-0.7963 -0.43991,-1.08296c-0.28703,-0.28666 -0.67792,-0.44486 -1.08353,-0.43852z"></path></g></g></svg>
                                </button>
                            </div>
                            <div>
                                <h1 class="font-semibold text-base text-fill text-left"> ${lstNm[i]}</h1>
                                <p class="font-medium text-base text-fill">Rp. ${lsthg[i]}</p>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <button data-idm=${lstidm[i]} data-hg=${lsthg[i]} onclick='krval(this);' class="submit bg-fill text-primary rounded-lg px-3.5 py-1 font-bold text-xl">-</button>
                                <input id=${lstidm[i]}-inp disabled type="number" min="1" class="text-xl font-semibold w-12 py-1.5 text-center bg-primary   " value=${lstVal[i]}>
                                <button data-idm=${lstidm[i]} data-hg=${lsthg[i]} onclick='tmbhval(this);' class="submit bg-fill text-primary rounded-md px-3 py-1 font-bold text-xl">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                        `
                        
                        
                        +cobustr ;   
            }
            // console.log(cobustr);
            lm.innerHTML = cobustr;
            
            ttlObj.innerHTML = formatRupiah(String(total), 'Rp. ');

        }





        /* --------------------- FUNGSI TAMBAH DAN KURANG VALUE MENU  --------------------- */
        function tmbhval (d) {
            const nama = d.getAttribute("data-idm");
            const hg   = d.getAttribute("data-hg");

            let ssd   = document.getElementById(nama+"-inp");
            let a1    = lstidm.indexOf(nama);
            ssd.value = Number(ssd.value)+1;
            lstVal[a1]+=1;
            total+= Number(hg);
            console.log(hg);
            ttlObj.innerHTML = formatRupiah(String(total), 'Rp. ');
        }

        function krval (d) {
            const nama = d.getAttribute("data-idm");
            const hg   = d.getAttribute("data-hg");

            let ssd = document.getElementById(nama+"-inp");
            let a1  = lstidm.indexOf(nama);

            if(Number(ssd.value) > 1)
            {
                lstVal[a1]-=1;
                ssd.value = Number(ssd.value)-1;
                total-=Number(hg);
                console.log(total);
                ttlObj.innerHTML = formatRupiah(String(total), 'Rp. ');
            }
            

        }
        /* --------------------- END FUNGSI TAMBAH DAN KURANG VALUE MENU  --------------------- */



        // Mendapatkan referensi elemen input
        const uangInput = document.getElementById('uang');
        const kembalianInput = document.getElementById('kembalian');

        // Mendengarkan perubahan nilai pada input uang
        uangInput.addEventListener('input', hitungKembalian);

        // Fungsi untuk menghitung kembalian
        function hitungKembalian() {
            const uang = parseFloat(uangInput.value);
            const kembalian = uang - total;
            kembalianInput.value = kembalian;
            const btnn = document.getElementById('submitBtn')

            if (kembalian < 0) {
                btnn.disabled = true;
            } else {
                btnn.disabled = false;
            }
        }

        // Memanggil fungsi hitungKembalian saat halaman dimuat untuk menginisialisasi tampilan kembalian
        hitungKembalian();


        /* --------------------- END FUNGSI TAMBAH DAN KURANG VALUE MENU  --------------------- */

        /* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}


    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>
</html>