<div class="loading" />

<style lang="scss">
  @mixin position-center($text-align: center) {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    text-align: $text-align;
  }

  .loading {
    @include position-center;
    margin: auto;
    border: 0.625rem solid var(--primary-lightest-color);
    border-radius: 50%;
    border-top: 0.625rem solid var(--secondary-color);
    width: 6.25rem;
    height: 6.25rem;
    animation: spinner 1.5s linear infinite;
  }

  @keyframes spinner {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }

  /*.loading {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
  }

   .loading-text {
    @include position-center;
    width: 100%;
    height: 100px;
    line-height: 100px;
    span {
      display: inline-block;
      margin: 0 5px;
      color: var(--secondary-draker-color);
      font-size: 2rem;
      font-family: var(--secondary-fonts);
      @for $i from 0 through 6 {
        &:nth-child(ide{$i + 1}) {
          filter: blur(0px);
          animation: blur-text 1.5s (ide{$i/5}) + s infinite linear alternate;
        }
      }
    }
  } */
</style>
