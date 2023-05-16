async function refreshGoldPrice() {
    try {
      while (true) {
        const response = await fetch("https://api.metals.live/v1/latest/XAU/USD");
        const data = await response.json();
        console.log(data);
        await new Promise(resolve => setTimeout(resolve, 10000));
      }
    } catch (error) {
      console.log(error);
    }
  }
  
  refreshGoldPrice();
  