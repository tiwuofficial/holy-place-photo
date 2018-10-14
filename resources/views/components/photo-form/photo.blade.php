<div class="p-photo-form__group p-photo-form__group--img">
  <div class="p-photo-form__group__name p-photo-form__group__name--img">
    <label for="photo_{{$id}}">
      写真をアップロード
      <input id="photo_{{$id}}" type="file" name="photos[]" @change="file_change('{{$id}}', $event)">
    </label>
    <p v-if="file['{{$id}}'].previewImageSrc !== ''" @click="clearImg('{{$id}}')">写真を取り消す</p>
  </div>
  <div class="p-photo-form__group__img-wrap">
    <img v-if="file['{{$id}}'].previewImageSrc !== ''" :src="file['{{$id}}'].previewImageSrc">
    <img v-else src="{{asset('img/no_image.png')}}">
  </div>
</div>