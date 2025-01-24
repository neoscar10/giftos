<style>
    .movable-cart-container {
    position: fixed;
    bottom: 50px;
    right: 50px;
    text-align: center;
    z-index: 1000;
    cursor: grab;
    width: 80px;
  }
  
  .movable-cart {
    width: 60px;
    height: 60px;
    border: 4px solid #750909;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #cd3232;
    font-size: 24px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .movable-cart:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
  }
  
  .movable-cart:active {
    cursor: grabbing;
  }
  
  .cart-name {
    margin-top: 8px;
    font-size: 14px;
    color: #59075c;
    font-weight: bold;
    font-family: 'Arial', sans-serif;
    transition: color 0.3s ease;
  }
  
  .movable-cart-container:hover .cart-name {
    color: #228b22;
  }
</style>



<a href="{{url('mycart')}}">
    <div id="cart-container" class="movable-cart-container" title="Your Cart">
      <div id="cart" class="movable-cart">
        <i class="fas fa-shopping-cart"></i>
        <span id="cart-count-1" style="position: absolute; top: 5px; right: 5px; background: #cd3232; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">{{$count}}</span>
      </div>
      <div class="cart-name">My Cart</div>
    </div>
  </a>


  