
<div id="app" class="container mt-5">
	<table class="table">
	<thead>
		<tr>
		<th scope="col" @click="change_sort('status')" :class="[(sort.field=='status')?'text-primary':'','sort']">
		статус
		<img v-if="sort.field=='status'" :src="getImgUrl" alt="">
		</th>
		<th scope="col" @click="change_sort('name')" :class="[(sort.field=='name')?'text-primary':'','sort']">
		Имя
		<img v-if="sort.field=='name'" :src="getImgUrl" alt="">
		</th>
		<th scope="col" @click="change_sort('email')" :class="[(sort.field=='email')?'text-primary':'','sort']">
		Email
		<img v-if="sort.field=='email'" :src="getImgUrl" alt="">
		</th>
		<th scope="col">задача</th>
		</tr>
	</thead>
	<tbody>
		<template v-for="item in list">
			<tr @click="edit_list({id:item.id,status:item.status,name:item.name,email:item.email,text:item.text})" class="edit_tr">
				<!-- <th v-if="item.status=='0'" >не выполнено</th>
				<th v-else>выполнено</th> -->
				<th>
					<img src="/images/done.png" alt="" title="Выполнено"v-if="item.status=='1'">
					<img src="/images/wait.png" alt="" title="Не выполнено"v-if="item.status=='0'">
					<img src="/images/edited.png" alt="" title="изменено администратором"v-if="item.modify=='1'">
				</th>
				<td class="td_name">{{item.name}}</td>
				<td class="td_email">{{item.email}}</td>
				<td>{{item.text}}</td>
			</tr>
		</template>
	</tbody>
	</table>
	 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Информация о задаче</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
				<div>
                    <div class="form-group row">
                        <label for="staticName" class="col-sm-2 col-form-label">Имя</label>
                        <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticName" :value="edit.name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" :value="edit.email">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" v-model="edit.status" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Выполнено
                        </label>
                        </div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Задача</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="edit.text"></textarea>
					</div>
					<div class="text-center">
						<button type="button" class="btn btn-outline-success" @click="save_changes">Сохранить</button>
						<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Закрыть</button>
					</div>
				</div>
        </div>
      </div>
    </div>
  </div>
</div>
