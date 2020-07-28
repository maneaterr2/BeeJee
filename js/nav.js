
new Vue({
    el:"#nav",
    data(){
        return{
            login:"",
            password:"",
            error_div:false,
        }
    },
    methods:{
        login_form:function(e){
            e.preventDefault();
            if(this.login == '' || this.password == '') {
                this.error_div = 'Нужно ввести имя и пароль';
            } else {
                this.error_div = false;
                let fm = new FormData();
                fm.append("login",this.login);
                fm.append("password",this.password);
                axios.post("/Main/login",fm)
                 .then(response=>{
                     if(response.data=="good"){
                         window.location = "cabinet/";
                     }else{
                        this.error_div = response.data;
                     }
                    })
            }
        },
        close_modal:function(){
            this.login = "";
            this.password = "";
            this.error_div = false;
        },
        logout:function(){
            axios.post("/Main/logout")
            .then(response=>{
                window.location = "/";
            })
        }
    }
})