@extends('layout')
@extends('header')
@extends('footer')

@section('title', 'Cart')
@section('content')



    @yield('header')

    <?php if(!defined('id')){
                $id = 0;
            }

    $Err = $user_name = $user_comment = $user_email = $user_phone = "";
    ?>









    <div class="pagecart" >
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Продукт</th>
            <th style="width:10%">Ціна</th>
            <th style="width:8%">Кількість</th>
            <th style="width:22%" class="text-center">Всього</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
        <?php use Illuminate\Support\Facades\DB;$total = 0 ?>
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                <?php $total += $details['price'] * $details['quantity'] ?>
                <tr>
                    <link rel="stylesheet" href="../css/style.css">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="../{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="text-right"> {{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-warning btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Всього {{ $total }}</strong></td>
        </tr>
        <tr>
            <td><a href="{{ url('/products') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i> Продовжити покупки</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Всього ${{ $total }}</strong></td>

        </tr>
        </tfoot>






    </table>


        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $prod = " ";




            if(session('cart')){
                foreach(session('cart') as $id => $details){
                    $prod .= "Товар:  ".$details['name']."  \n"."Кількість:   ".$details['quantity']."  \n\n ";


                }

            }



            //$name = $_POST["user_name"];



            if (empty($_POST["user_name"]) || empty($_POST["user_phone"]) ||empty($_POST["user_email"])) {
                $Err = "Необхідно заповнити всі поля позначені ' * ' ";
                $name = "";
            } else {
                $user_name = test_input($_POST["user_name"]);
                $user_phone = test_input($_POST["user_phone"]);
                $user_email = test_input($_POST["user_email"]);
                $user_comment = test_input($_POST["user_comment"]);





                DB::table('cart_order')->insert([
                    'name' => $prod,
                    'total' => $total,
                    'user_name' => $user_name,
                    'user_phone' => $user_phone,
                    'user_email' => $user_email,
                    'user_comment' => $user_comment
                ]);




            }







        }


        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        ?>








    <form method="post" class="ask_form">
        @csrf
        <header class="form_head">Оформити замовлення:</header>
        <div class="fields_container">
            <div class="fields">
                <div class="d"><input type="text" placeholder="Ім'я" name="user_name" autocomplete="off" class="user_name">   <span class="error">* <?php echo $Err;?> </span>     </div>
                <div class="d"><input type="text" placeholder="Ваш телефон:" name="user_phone" autocomplete="off" class="user_phone"></div>
                <div class="d"><input type="text" placeholder="E-mail:" name="user_email" autocomplete="off" class="user_email" ></div>
            </div>
            <div class="d"><textarea rows = "5" cols = "60"  placeholder="Коментар:" name="user_comment" autocomplete="off" class="bigfield" ></textarea></div>
        </div>
        <button class="btn btn-warning btn-sm"><a>Відправити замовлення</a></button>
    </form>


    </div>













@endsection
@section('scripts')
    <script type="text/javascript">
        $(".update-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
                success: function (response) {
                    window.location.reload();
                }
            });
        });
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Ви впевнені?")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });



{{--        $(".senddata").click(function (e) {--}}
{{--            e.preventDefault();--}}
{{--            <?php $prod = " "; ?>--}}
{{--            if(confirm("Ви впевнені?")) {--}}
{{--                @if(session('cart'))--}}
{{--                @foreach(session('cart') as $id => $details)--}}


{{--                <?php--}}
{{--                $prod .= "Товар:  ".$details['name']."  \n"."Кількість:   ".$details['quantity']."  \n\n ";--}}
{{--                ?>--}}


{{--                @endforeach--}}
{{--                @endif--}}

{{--                <?php--}}
{{--//--}}
{{--           //     $your_name = htmlspecialchars($_POST["your_name"]);--}}
{{--//                $email = htmlspecialchars($_POST["email"]);--}}
{{--//                $tema = htmlspecialchars($_POST["tema"]);--}}
{{--//                $message = htmlspecialchars($_POST["messages"]);--}}

{{--                $z = 'kl';--}}
{{--               // $z = $_POST["name"]--}}

{{--                ?>--}}

{{--                <?php--}}

{{--                DB::table('cart_order')->insert([--}}
{{--                    'name' => $prod,--}}
{{--                    'total' => $total--}}
{{--                    //'user_name' =>--}}

{{--                ]);--}}
{{--                ?>--}}
{{--            }--}}
{{--        });--}}






    </script>


    @yield('footer')

@endsection
