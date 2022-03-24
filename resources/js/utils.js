export const mixins = {
    data() {
        return {
            logoB: '/img/tecnotanques/logo-blanco.png',
            logo: '/img/tecnotanques/logo.png',
            index: 0,
            show: true,
            isOpenSub: false,
            isOpenMar: false,
            isOpenSubM: false,
            isOpenMarM: false,
            modalForm: false,
            modalFormCatalog: false,
            modalNewsletter: false,
            activeTab: 0,
            order: '',
            currentPath: '',
            product: {},
            clasification: 0,
            activeQuote: false,
            productSelected: null,
            productSelectedVariants: null
        }
    },
    mounted() {
        this.navbarStyles(false);
        if (document.getElementById("modalNewsletter")) {
            this.showModalNewsletter()
        }
        this.currentPath = window.location.href
        if (this.currentPath.indexOf('?') > -1) {
            this.currentPath = this.currentPath.split('?')[1]
            if (this.currentPath.indexOf('&') > -1) {
                let order = this.currentPath.split('&')[0]
                order = order.split('=')[1]
                this.order = order
            } else {
                this.currentPath = this.currentPath.split('=')[1]
                this.order = this.currentPath
            }
        } else {
            this.order = ''
        }

        setTimeout(() => {
            if (this.currentPath.includes('productos')) {
                document.getElementById('allModals').classList.remove('hidden')
            }
            if (document.getElementById("modalNewsletter")) {
                document.getElementById('modalNewsletter').classList.remove('hidden')
                // console.log('Show News')
            }
            this.$forceUpdate()
        }, 1000)
    },
    methods: {
        // getUrl(data, type, action) {
        //     let currentPath = window.location.pathname
        //     let href = window.location.href
        //     if (href.indexOf('?') > -1) {
        //         currentPath = currentPath.split('/')
        //         let queryParams = href.split('?')[1]
        //         return this.returnUri(type, data, currentPath, queryParams, action);
        //     } else {
        //         currentPath = currentPath.split('/')
        //         return this.returnUri(type, data, currentPath, '', action);
        //     }
        // },
        number_format(number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        },
        submitCatalog(e) {
            const apiUrl = 'http://tecnotanques.sw.sw/';
            e.preventDefault();
            let data =  {
                _token: this.$refs.catalogForm._token.value,
                recaptcha_token: this.$refs.catalogForm.recaptcha_token.value,
                catalog_id: this.$refs.catalogForm.catalog_id.value,
                catalog_url: this.$refs.catalogForm.catalog_url.value,
                name: this.$refs.catalogForm.name.value,
                email: this.$refs.catalogForm.email.value,
            }
            
            if (true) {
                this.postData('/catalogo', data)
                    .then(res => {
                        if (res === 200) {
                            this.closeCatalog()
                            window.location.assign(data.catalog_url)
                        } else {
                            this.$toasted.show("Ocurrio un error, por favor intente mas tarde.", { type: 'error'})
                        }
                    });
            }
        },
        validateForms(data) {
            let keys = Object.keys(data)
            let flag = true;
            for (let index = 0; index < keys.length; index++) {
                if (keys[index] !== 'recaptcha_token') {
                    if (data[keys[index]] === '') {
                        // console.log(keys[index]);
                        let dictionary = {
                            'name': 'nombre',
                            'email': 'correo',
                        }
                        this.$toasted.show(`Por favor agregue el campo de ${dictionary[keys[index]]} para continuar.`, { type: 'error' })
                        flag = false
                        return flag
                    }
                }
            }
            return flag
        },
        // Ejemplo implementando el metodo POST:
        async postData(url = '', data = {}) {
            // Opciones por defecto estan marcadas con un *
            const response = await fetch(url, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                    'Content-Type': 'application/json'
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify(data) // body data type must match "Content-Type" header
            });
            return response.json(); // parses JSON response into native JavaScript objects
        },
        
        returnUri(type, data, currentPath, queryParams, action) {
            let uri = ''
            if (action !== 'remove') {
                if (type === 'category') {
                    if (queryParams !== '') {
                        uri = `/productos/${data.url}/todas-las-subcategorias/todas-las-marcas?${queryParams}`
                    } else {
                        uri = `/productos/${data.url}/todas-las-subcategorias/todas-las-marcas`
                    }
                    return uri 
                } else if (type === 'subcategory') {
                    if (queryParams !== '') {
                        uri = `/productos/${currentPath[2]}/${data.url}/${currentPath[4]}?${queryParams}`
                    } else {
                        uri = `/productos/${currentPath[2]}/${data.url}/${currentPath[4]}`
                    }
                    return uri
                } else {
                    if (queryParams !== '') {
                        uri = `/productos/${currentPath[2]}/${currentPath[3]}/${data.id}?${queryParams}`
                    } else {
                        uri = `/productos/${currentPath[2]}/${currentPath[3]}/${data.id}`
                    }
                    return uri
                }
            } else {
                if (type === 'category') {
                    if (queryParams !== '') {
                        uri = `/productos/${data.url}/todas-las-subcategorias/todas-las-marcas?${queryParams}`
                    } else {
                        uri = `/productos/${data.url}/todas-las-subcategorias/todas-las-marcas`
                    }
                    return uri 
                } else if (type === 'subcategory') {
                    if (queryParams !== '') {
                        uri = `/productos/${currentPath[2]}/todas-las-subcategorias/${currentPath[4]}?${queryParams}`
                    } else {
                        uri = `/productos/${currentPath[2]}/todas-las-subcategorias/${currentPath[4]}`
                    }
                    return uri
                } else {
                    if (queryParams !== '') {
                        uri = `/productos/${currentPath[2]}/${currentPath[3]}/todas-las-marcas?${queryParams}`
                    } else {
                        uri = `/productos/${currentPath[2]}/${currentPath[3]}/todas-las-marcas`
                    }
                    return uri
                }
            }

        },
        onChangeOrder() {
            if (this.order === '-') {
                if (window.location.href.indexOf('?') > -1) {
                    let uri = window.location.href;
                    uri = uri.split('?')[0]
                    window.location.href = uri
                }
            } else {
                window.location.href = `?sort_order=${this.order}`;
            }
        },
        onWaypoint({ going, direction, el }) {
            // going: in, out
            // direction: top, right, bottom, left
            if (going === this.$waypointMap.GOING_IN) {
                // console.log('waypoint going in!', el.id)
                switch (el.id) {
                    case 'hero':
                        el.classList.add('fadeIn')
                        break;
                    case 'services':
                        el.classList.add('fadeIn')
                        el.classList.add('animation-fast')
                        break;
                    case 'trademarks':
                        el.classList.add('fadeIn')
                        el.classList.add('animation-slow')
                        break;
                    case 'quote':
                        this.activeQuote = true
                        el.classList.add('fadeInUp')
                        el.classList.add('animation-fast')
                        break;
                    default:
                        el.classList.add('fadeInUp')
                        el.classList.add('animation-fast')
                        break;
                }
            }
            if (going === this.$waypointMap.GOING_OUT) {
                // console.log('waypoint going in!', el.id)
                switch (el.id) {
                    case 'hero':
                        el.classList.remove('fadeIn')
                        break;
                    case 'services':
                        el.classList.remove('fadeIn')
                        el.classList.remove('animation-fast')
                        break;
                    case 'trademarks':
                        el.classList.remove('fadeIn')
                        el.classList.remove('animation-slow')
                        break;
                    case 'quote':
                        this.activeQuote = false
                        el.classList.add('fadeInUp')
                        el.classList.add('animation-fast')
                        break;
                    default:
                        el.classList.remove('fadeInUp')
                        el.classList.remove('animation-fast')
                        break;
                }
            }
        },
        showModal(product, category) {
            let modalForm = document.getElementById("modalForm");
            let allModals = document.getElementById("allModals");
            if (this.modalForm) {
                modalForm.classList.add("hidden")
            } else {
                modalForm.classList.remove("hidden")
                allModals.classList.remove("hidden")
            }
            this.product = product;
            this.clasification = category.classification_id
            this.modalForm = !this.modalForm
        },
        showModalCatalog() {
            let modalFormCatalog = document.getElementById("modalFormCatalog");
            if (this.modalFormCatalog) {
                modalFormCatalog.classList.add("hidden")
            } else {
                modalFormCatalog.classList.remove("hidden")
            }
            this.modalFormCatalog = !this.modalFormCatalog
        },
        closeCatalog() {
            this.modalFormCatalog = !this.modalFormCatalog
            let modalFormCatalog = document.getElementById("modalFormCatalog");
            if (this.modalFormCatalog) {
                modalFormCatalog.classList.add("hidden")
            } else {
                modalFormCatalog.classList.remove("hidden")
            }
        },
        showModalNewsletter() {
            // console.log('hey');
            this.modalNewsletter = true
        },
        closeNewsletter() {
            this.modalNewsletter = false
        },
        closeNewsletterById(id)
        {
            let newsLetterCatalog = document.getElementById("modalNewsletter"+id);
            if (newsLetterCatalog) {
                newsLetterCatalog.classList.add("hidden")
            }
        },
        close() {
            this.product = {};
            this.modalForm = false
        },
        goProduct(id) {
            window.location.href = `/productos/${id}`;
        },
        scrollToTop() {
            window.scrollTo(0, 0);
        },
        open(type) {
            let button = document.getElementById(type);
            if (this[type]) {
                button.style.transform = "rotate(180deg)";
            } else {
                button.style.transform = "rotate(360deg)";
            }
            this[type] = !this[type];
        },
        navbarStyles(status) {
            let navbarMd = document.getElementById("navbarMd");
            let navbarXs = document.getElementById("navbarXs");
            let navbarHelper = document.getElementById("navbarHelper");
            let navbarHelperXs = document.getElementById("navbarHelperXs");
            
            
            let buttonsClass = document.getElementsByClassName("buttonAnimation");
            let buttonsContact = document.getElementById("buttonNav5");

            let logo = document.getElementById("logo");
            if  (window.location.pathname === '/') {
                if (status) {
                    buttonsContact.classList.remove('border-white')
                    buttonsContact.classList.add('border-gray-100')
                    navbarMd.classList.remove("bg-transparent")
                    navbarMd.classList.add("shadow-xl")
                    navbarMd.classList.add("bg-white")
                    navbarHelper.classList.add('fixed');
                    navbarHelper.classList.remove('h-8');
                    navbarHelper.classList.add('h-6');

                    navbarHelperXs.classList.add('fixed');
                    navbarHelperXs.classList.remove('h-8');
                    navbarHelperXs.classList.add('h-6');
                    navbarXs.classList.add("top-24")
                    
                    navbarMd.classList.add("top-24")
                    for (var i = 0; i < buttonsClass.length; i++) {
                        buttonsClass[i].classList.remove("text-whiteSmoke-100")
                        buttonsClass[i].classList.add("text-gray-100")
                    }
                    logo.src = this.logo
                } else {
                    buttonsContact.classList.add('border-white')
                    buttonsContact.classList.remove('border-gray-100')
                    navbarMd.classList.remove("bg-white")
                    navbarMd.classList.remove("shadow-xl")
                    navbarMd.classList.add("bg-transparent")
                    navbarHelper.classList.remove('fixed');
                    navbarHelper.classList.remove('h-6');
                    navbarHelper.classList.add('h-8');

                    navbarHelperXs.classList.remove('fixed');
                    navbarHelperXs.classList.remove('h-6');
                    navbarHelperXs.classList.add('h-8');
                    navbarXs.classList.remove("top-24")

                    navbarMd.classList.remove("top-24")
                    for (var i = 0; i < buttonsClass.length; i++) {
                        buttonsClass[i].classList.remove("text-gray-100")
                        buttonsClass[i].classList.add("text-whiteSmoke-100")
                    }
                    logo.src = this.logoB
                }
            } else {
                if (status) {
                    navbarHelper.classList.add('fixed');
                    navbarHelper.classList.remove('h-8');
                    navbarHelper.classList.add('h-6');
                    navbarMd.classList.add("top-24")

                    navbarHelperXs.classList.add('fixed');
                    navbarHelperXs.classList.remove('h-8');
                    navbarHelperXs.classList.add('h-6');
                    navbarXs.classList.add("top-24")

                    navbarMd.classList.add("md:shadow")
                    navbarXs.classList.add("shadow-xl")
                } else {
                    navbarHelper.classList.remove('fixed');
                    navbarHelper.classList.remove('h-6');
                    navbarHelper.classList.add('h-8');
                    navbarMd.classList.remove("top-24")

                    navbarHelperXs.classList.remove('fixed');
                    navbarHelperXs.classList.remove('h-6');
                    navbarHelperXs.classList.add('h-8');
                    navbarXs.classList.remove("top-24")

                    navbarMd.classList.remove("md:shadow")
                    navbarXs.classList.remove("shadow-xl")
                }

                navbarMd.classList.remove("bg-transparent")
                navbarMd.classList.add("bg-white")
                for (var i = 0; i < buttonsClass.length; i++) {
                    buttonsClass[i].classList.remove("text-whiteSmoke-100")
                    buttonsClass[i].classList.add("text-gray-100")
                }
                logo.src = this.logo
            }
        },
        scrollFunction() {
            let scrollButton = document.getElementById("scrollTop");
            let whatssap = document.getElementById("whatssap");
            let phoneButton = document.getElementById("phoneButton");
            if (this.detectMob()) {
                scrollButton.style.display = "none";
                scrollButton.classList.add("fadeInDown")
                this.navbarStyles(true)
            } else {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    scrollButton.style.display = "block";
                    scrollButton.classList.add("fadeInDown")
                    
                    whatssap.style.right = '110px';
                    whatssap.classList.add("fadeIn")
                    phoneButton.style.right = '190px';
                    phoneButton.classList.add("fadeIn")
                    this.navbarStyles(true)
                } else {
                    scrollButton.style.display = "none";
                    scrollButton.classList.add("fadeInDown")
    
                    whatssap.style.right = '30px';
                    whatssap.classList.add("fadeIn")
                    phoneButton.style.right = '110px';
                    phoneButton.classList.add("fadeIn")
                    this.navbarStyles(false)
                }
            }
        },
        detectMob() {
            const toMatch = [
                /Android/i,
                /webOS/i,
                /iPhone/i,
                /iPad/i,
                /iPod/i,
                /BlackBerry/i,
                /Windows Phone/i
            ];

            return toMatch.some((toMatchItem) => {
                return navigator.userAgent.match(toMatchItem);
            });
        }
    },
}
