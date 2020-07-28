
<div id="app" class="container mt-5">
	<div class="text-center">
	<button type="button" class="btn btn-outline-secondary" disabled>Сортировка</button>
	<button type="button" :class="[(sort.field=='status')?'btn-outline-info':'btn-outline-secondary','btn']"@click="change_sort('status')">
		статус
		<img v-if="sort.field=='status'" :src="getImgUrl" alt="">
	</button>
	<button type="button" :class="[(sort.field=='name')?'btn-outline-info':'btn-outline-secondary','btn']"@click="change_sort('name')">
		Имя
		<img v-if="sort.field=='name'" :src="getImgUrl" alt="">
	</button>
	<button type="button" :class="[(sort.field=='email')?'btn-outline-info':'btn-outline-secondary','btn']"@click="change_sort('email')">
		Email
		<img v-if="sort.field=='email'" :src="getImgUrl" alt="">
	</button>
	</div>
		<template v-for="item in list">
			<div class="cs_card">
				<div class="cs_progress">
					<span v-if="item.modify=='1'"style="background-color:#fe8b47;color:#fff;margin-rigth:10px">Изменено администратором</span>
					<span v-if="item.status=='0'">не выполнено</span>
					<span v-else style="background-color:#009900;color:#fff">выполнено</span>
				</div>
				<div class="cs_info">
					<img src="/images/face_1.jpg" alt="" class="cs_img">
					<div>
						<span>{{item.name}}<br>{{item.email}}</span>
					</div>
				</div>
				<div style="margin-top:10px;text-align:left">
					<h3>Задача</h3>
					<p>{{item.text}}</p>
				</div>

			</div>
		</template>
	<div v-if="pages>1" class="my-4">
		<div class="row justify-content-md-center">
		<div class="col-md-auto">
		
		<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
		<div class="btn-group mr-2" role="group" aria-label="First group">
			<button class="btn btn-outline-secondary" v-if="count>0":class="[ (active_page==1) ? activeClass : '' ]"@click="otherPage('1')" type="button">начало</button>
		</div>
		<div class="btn-group mr-2" role="group" aria-label="Second group">
			<template v-for="page in pages">
			<button v-if="active_paginator(page)" class="btn btn-outline-secondary" :class="[ (active_page==page) ? activeClass : '' ]"@click="otherPage(page)" type="button">{{page}}</button>
			</template>
		</div>
		<div class="btn-group" role="group" aria-label="Third group">
			<button class="btn btn-outline-secondary"v-if="count>0" :class="[ (active_page==pages) ? activeClass : '' ]"@click="otherPage(pages)" type="button">{{pages}}</button>
		</div>
		</div>
		</div>
	</div>
	</div>

	<div class="text-center">
		<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#addModal">Добавить задачу</button>

	</div>
	 <!-- Modal -->
	 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Новая задача</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
				<div>
					<div :class="[(error_add=='Задача добавлена')?'alert-success':'alert-danger','alert']"v-show="error_add" role="alert" style="display:none">
						{{error_add}}
					</div>
					<div class="form-group">
						<label for="name">Ваше имя</label>
						<input type="text" class="form-control" id="name" placeholder="name@example.com" v-model="new_task.name">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" placeholder="name@example.com" v-model="new_task.email">
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Задача</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="new_task.text"></textarea>
					</div>
					<div class="text-center">
						<button type="button" class="btn btn-outline-success" @click="add_list">Добавить задачу</button>
						<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Закрыть</button>
					</div>
				</div>
        </div>
      </div>
    </div>
  </div>
</div>
