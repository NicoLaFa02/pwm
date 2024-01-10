<style>

footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    padding: 20px 0;
}

.footer-links {
    display: flex;
}

.footer-links a {
    text-decoration: none;
    color: white;
    margin-right: 40px;
}

.nome_sito {
    /* display: inline; */
    text-align: right;
    flex-grow: 1;
}

</style>

<footer>
    <div class="footer-content">
        <div class="footer-links">
            <a href="http://www.github.com/NicoLaFa02/pwm">GitHub</a>
            <a href="contatti.php">Contatti</a>
            <div class="nome_sito">&copy; <?php echo date("Y"); ?> RecenField   c</div>
        </div>
    </div>
</footer>