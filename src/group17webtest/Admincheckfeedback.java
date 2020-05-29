package group17webtest;

import java.util.concurrent.TimeUnit;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;



public class Admincheckfeedback {
public static void main(String[] args) {
		
		System.setProperty("webdriver.chrome.driver", "chromedriver");
	
		WebDriver driver = new ChromeDriver();

		driver.get("https://salty-scrubland-05316.herokuapp.com/");
		driver.manage().timeouts().implicitlyWait(200, TimeUnit.SECONDS);	
		WebDriverWait wait = new WebDriverWait(driver,50);
		
		driver.findElement(By.linkText("Login")).click();
		
		
		driver.findElement(By.name("email")).sendKeys("admin@carabc.com");
		driver.findElement(By.name("password")).sendKeys("admin000");
		driver.findElement(By.xpath("//*[@id=\'app\']/main/div/div/div/div/div[2]/form/div[4]/div/button")).click();
		
		driver.findElement(By.xpath("//*[@id=\'navbarDropdown\']")).click();
		driver.findElement(By.xpath("//*[@id=\'navbarSupportedContent\']/ul/li[2]/div/a[2]")).click();
		
		
}
}


