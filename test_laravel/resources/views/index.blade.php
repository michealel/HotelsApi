<form action="{{route('firstApi')}}" method="post" name="form1" >
    <div class="form-group">
        <label for="">search by Hotel Name</label>
        <input type="text"   placeholder="Hotel Name" name="hotelName"/>
        <input type="hidden" name="_token" value="{{csrf_token()}}">

    </div>
    <div class="form-group">
        <label for="">search by Destination</label>
        <input type="text"  placeholder="Destination" name="Destination"/>
    </div>
    <div class="form-group">
        <label for="">search by Price range</label>
        <input type="number"  placeholder="minim price" name="price1"/>
        <input type="number"   placeholder="max price" name="price2"/>
    </div>
    <div class="form-group">
        <label for="">Date range</label>
        <input placeholder="ex: 10-10-2020" name="date1"/>
        <input placeholder="ex: 10-10-2020" name="date2"/>
    </div>
    <p class="text-left">
        <button type="submit" > {{trans('actions.send')}} <i  aria-hidden="true"></i></button>
    </p>

</form>
