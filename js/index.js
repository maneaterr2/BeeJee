new Vue({
    el:"#app",
    data(){
        return{
            list:null,
            active_page:1,
            pages:null,
            limit:3,
            activeClass: 'active',
            count:null,
            error_add:false,
            new_task:{
                name:"",
                email:"",
                text:"",
            },
            sort:{
                field:"",
                way:true,
            }
        }
    },
    mounted(){
        this.get_list();
    },
    computed:{
        getImgUrl() {
            if(this.sort.way){
                return "/images/up.png";
            }else{
                return "/images/down.png";
            }
          }
    },
    methods:{
        get_list:function(){
            let fm = new FormData();
            fm.append("current_skip",this.active_page)
            fm.append("sort_field",this.sort.field)
            if(this.sort.way){
                fm.append("sort_way",'ASC')
            }else{
                fm.append("sort_way","DESC")
            }
            
            axios.post("/Main/get_list/",fm)
            .then(response=>{
                console.log(response.data)
                this.list = response.data.data;
                this.count = response.data.count;
                this.paginator();
            })
        },
        add_list:function(){
            if(this.new_task.name!=""&&this.new_task.email!=""&&this.new_task.text!=""){
                let fm = new FormData();
                for(key in this.new_task){
                    fm.append(key,this.new_task[key])
                }
                axios.post("/Main/add_list/",fm)
                .then(response=>{
                    console.log(response.data)
                    if(response.data.error=="email"){
                        this.error_add = "не корректно введён email";
                    }else{
                        for(key in this.new_task){
                            this.new_task[key] = "";
                        }
                        this.error_add = "Задача добавлена";
                        setTimeout(() => {
                            this.error_add = false;
                            $("#addModal [data-dismiss=modal]").trigger({ type: "click" })
                        }, 1500);
                        this.get_list();
                    }
                    
                })
            }else{
                
                this.error_add = "Нужно заполнить все поля";
                setTimeout(() => {
                    this.error_add = false;
                }, 1500);
            }
        },
        otherPage: function(page){
            if(page<=this.pages&&page>0){
                this.active_page = page;
                this.get_list();
            }
        },
        paginator:function(){
          this.pages = Math.ceil(this.count / this.limit);
        },
        active_paginator:function(index){
            let check;
            if(this.active_page<2){
              check = 0
            }else{
              check = this.active_page-2;
            }
            if(index>=check&&index<(check+5)){
              return true;
            }else{
              return false;
            }
            
        },
        change_sort:function(field){
            if(this.sort.field!=field){
                this.sort.field=field;
                this.sort.way = true;
            }else{
                this.sort.way = !this.sort.way;
            }
            this.active_page = 1;
            this.get_list();
        }
    }
})