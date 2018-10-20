<div class="p-photo-form__group--map">
  <h2 class="p-photo-form__group--map__header">地図</h2>
  <div class="p-photo-form__group--map__input-wrap">
    <label for="lat">緯度</label>
    <input type="text" name="lat" id="lat" v-model="photo.lat" class="c-input-text">
    <label for="lng">経度</label>
    <input type="text" name="lng" id="lng" v-model="photo.lng" class="c-input-text">
  </div>
  <div class="p-photo-form__group--map__input-wrap">
    <p>地名の検索ができます</p>
    <input type="text" v-model="address" class="c-input-text">
    <button type="button" @click="mapSearch" class="c-button">検索</button>
  </div>
  <div id="map" class="p-photo-form__group--map__gmap"></div>
</div>
