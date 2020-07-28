new Vue({
    el:"#app",
    data(){
        return{
            list:null,
            limit:300000,
            count:null,
            sort:{
                field:"",
                way:true,
            },
            edit:{
                id:"",
                name:"",
                status:"",
                email:"",
                text:""
            },
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
            fm.append("sort_field",this.sort.field)
            fm.append("limit",this.limit)
            if(this.sort.way){
                fm.append("sort_way",'ASC')
            }else{
                fm.append("sort_way","DESC")
            }
            
            axios.post("/Main/get_list/",fm)
            .then(response=>{
                this.list = response.data.data.map((el)=>{
                    if(el.status==='0'){
                        el.status = false;
                    }else{
                        el.status = true;
                    }
                    return el;
                });
                this.count = response.data.count;
            })
        },
        edit_list:function(obj){
            for(key in this.edit){
                this.edit[key] = obj[key];
            }
            $('#editModal').modal('show')
        },
        save_changes:function(){
            let fm = new FormData();
            if(this.edit.status){
                this.edit.status = '1';
            }else{
                this.edit.status = '0';
            }
            for(key in this.edit){
                fm.append(key,this.edit[key])
            }
            axios.post("/Main/save_task/",fm)
            .then(response=>{
                if(response.data.message=="main_page"){
                    window.location = "/";
                }else{
                    $("#editModal [data-dismiss=modal]").trigger({ type: "click" })
                    this.get_list();
                }
               
            })
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