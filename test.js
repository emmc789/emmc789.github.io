
  // 🎭 Lista ampliada de emojis
  const EMOJIS = [
    "😀","😂","🤣","😍","😎","🤯","😱","👻","💀","👽","🤖","🎃","🐍","🦊","🐉","🐙","🦄","🐧","🐢","🐝",
    "🌸","🌻","🌈","🔥","⚡","💫","⭐","🌍","🌌","🌞","🌜","🌟","🍕","🍔","🍟","🍩","🍭","🍫","🍺","🍷","☕",
    "🎉","🎊","🎶","🎮","🎲","🕹️","🏆","⚽","🏀","🏈","🥊","🚀","✈️","🚗","🚲","🛸","🪐","🌋","🏝️","🏔️"
  ];

  const RAIN_COUNT = 1; // más emojis por lluvia
  const LIFETIME = 3000; // ms antes de empezar a caer
  const FALL_SPEED = 3;  // velocidad de caída

  const rand = (min, max) => Math.random() * (max - min) + min;
  const pick = arr => arr[Math.floor(Math.random() * arr.length)];

  function spawnEmoji(x, y) {
    const el = document.createElement("div");
    el.textContent = pick(EMOJIS);
    el.style.position = "fixed";
    el.style.left = x + "px";
    el.style.top = y + "px";
    el.style.fontSize = rand(20, 40) + "px";
    el.style.pointerEvents = "none";
    el.style.transform = `translate(-50%, -50%)`;
    el.style.transition = "top 1s ease-in, opacity 1s ease-out";
    document.body.appendChild(el);

    // Después de un tiempo, empieza a caer y desvanecerse
    setTimeout(() => {
      el.style.top = window.innerHeight + "px";
      el.style.opacity = "0";
      setTimeout(() => el.remove(), 1200); // se borra después de caer
    }, LIFETIME);
  }

  function emojiRainFrom(x, y) {
    for (let i = 0; i < RAIN_COUNT; i++) {
      setTimeout(() => spawnEmoji(x + rand(-80, 80), y + rand(-40, 40)), i * 20);
    }
  }

  // Click/touch para lluvia
  const clickHandler = e => {
    const x = e.clientX ?? (e.touches && e.touches[0].clientX);
    const y = e.clientY ?? (e.touches && e.touches[0].clientY);
    if (x != null && y != null) emojiRainFrom(x, y);
  };
  window.addEventListener("click", clickHandler, { passive: true });
  window.addEventListener("touchstart", clickHandler, { passive: true });
  window.addEventListener("mousemove", e => {
    emojiRainFrom(e.clientX, e.clientY);
  });

