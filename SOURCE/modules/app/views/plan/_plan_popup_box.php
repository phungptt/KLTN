<div class="stay-time-box place-editing-box position-absolute" v-if="openStayTimeBox">
    <div class="card-body p-2 d-flex flex-column">
        <div class="d-flex justify-content-between p-2">
            <input type="number" min="0" max="23" class="form-control mr-2" id="stay-time-hour" :value="Math.floor(dataOfPlaceEditing.time_stay / 60)">
            <input type="number" min="0" max="59" class="form-control" id="stay-time-minute" :value="dataOfPlaceEditing.time_stay % 60">
        </div>
        <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-primary btn-sm btn-box-custom mr-2" @click="saveStayTime">Lưu</button>
            <button class="btn btn-danger btn-sm btn-box-custom" @click="openStayTimeBox = false">Đóng</button>
        </div>
    </div>
</div>
<div class="free-time-box place-editing-box position-absolute" v-if="openFreeTimeBox">
    <div class="card-body p-2 d-flex flex-column">
        <div class="d-flex justify-content-between p-2">
            <input type="number" min="0" max="23" class="form-control mr-2" id="free-time-hour" :value="Math.floor(dataOfPlaceEditing.free_time / 60)">
            <input type="number" min="0" max="59" class="form-control" id="free-time-minute" :value="dataOfPlaceEditing.free_time % 60">
        </div>
        <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-primary btn-sm btn-box-custom mr-2" @click="saveFreeTime">Lưu</button>
            <button class="btn btn-danger btn-sm btn-box-custom" @click="openFreeTimeBox = false">Đóng</button>
        </div>
    </div>
</div>
<div class="start-time-box place-editing-box position-absolute" v-if="openStartTimeBox">
    <div class="card-body p-2 d-flex flex-column">
        <div class="d-flex justify-content-between p-2">
            <input type="number" min="0" max="23" class="form-control mr-2" id="start-time-hour" :value="Math.floor(dataOfPlaceEditing.time_start / 60)">
            <input type="number" min="0" max="59" class="form-control" id="start-time-minute" :value="dataOfPlaceEditing.time_start % 60">
        </div>
        <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-primary btn-sm btn-box-custom mr-2" @click="saveStartTime">Lưu</button>
            <button class="btn btn-danger btn-sm btn-box-custom" @click="openStartTimeBox = false">Đóng</button>
        </div>
    </div>
</div>
<div class="transfer-type-box place-editing-box position-absolute" v-if="openTransferTypeBox">
    <div class="card-body p-2 d-flex flex-column">
        <ul class="media-list media-list-linked py-2">
            <li v-for="(trans, idx) in transferType">
                <div class="media py-1 px-3 cursor-pointer" @click="chooseTransferType(idx)">
                    <div class="mr-3">
                        <i :class="trans.icon"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="media-title">{{ trans.label }}</h6>
                    </div>
                </div>
            </li>
        </ul>
        <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-danger btn-sm btn-box-custom" @click="openTransferTypeBox = false">Đóng</button>
        </div>
    </div>
</div>
<div class="note-box place-editing-box position-absolute" v-if="openNoteBox">
    <div class="card-body p-2 d-flex flex-column">
        <textarea name="" id="" cols="35" rows="4" v-model="dataOfPlaceEditing.note"></textarea>
        <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-primary btn-sm btn-box-custom mr-2" @click="savePlaceNote">Lưu</button>
            <button class="btn btn-danger btn-sm btn-box-custom" @click="openNoteBox = false">Đóng</button>
        </div>
    </div>
</div>